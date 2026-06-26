<?php
/**
 * mp_webhook.php
 * ──────────────
 * Receptor de notificaciones de MercadoPago (Checkout Pro) para Argentina.
 *
 * Flujo:
 *   1. MP avisa (IPN/webhook) con el id de un pago o de una merchant_order.
 *   2. Re-consultamos el pago a la API de MP con el access token. ESA es la
 *      validación real (no confiamos en el payload).
 *   3. Si status === 'approved', marcamos la venta como DONE y damos de alta
 *      al alumno en la Academia (enviarAltaAcademia con fuente=mercadopago).
 *
 * Idempotente: si la venta ya está DONE, no reprocesa (evita altas/ventas
 * duplicadas cuando MP reenvía la notificación, o si pago_exitoso.php ya corrió
 * la red de seguridad).
 */

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ini_set('display_errors', 0);

header('Content-Type: application/json');

require_once __DIR__ . '/a-libraries/vendor/autoload.php';
// funcionsDBStripe ya incluye conexion.php (OpenCon) y define enviarAltaAcademia.
include(__DIR__ . '/a-includes/funcionsDBStripe.php');

$mpToken = getenv('MP_ACCESS_TOKEN_IDIOMAS') ?: (getenv('MP_ACCESS_TOKEN') ?: '');
if (empty($mpToken)) {
    http_response_code(500);
    error_log('mp_webhook idiomas: MP_ACCESS_TOKEN(_IDIOMAS) no configurado');
    echo json_encode(['error' => 'mp_token_missing']);
    exit;
}

// ─── Tipo de notificación e id involucrado (soporta formatos viejos y nuevos) ─
$rawBody  = file_get_contents('php://input');
$bodyJson = json_decode($rawBody, true);
if (!is_array($bodyJson)) $bodyJson = [];

$tipo = strtolower(trim($_GET['type'] ?? $_GET['topic'] ?? ($bodyJson['type'] ?? '')));
$notifId = trim((string) ($_GET['data.id'] ?? ($_GET['id'] ?? ($bodyJson['data']['id'] ?? ($bodyJson['id'] ?? '')))));

if ($tipo === '' && $notifId === '') {
    http_response_code(200);
    echo json_encode(['status' => 'ignored', 'reason' => 'sin_tipo_ni_id']);
    exit;
}

$mpClient = new \GuzzleHttp\Client(['timeout' => 15, 'http_errors' => false]);

function mpWebhookGet($mpClient, $url, $mpToken) {
    try {
        $resp = $mpClient->get($url, ['headers' => ['Authorization' => 'Bearer ' . $mpToken]]);
        if ($resp->getStatusCode() >= 400) {
            error_log('mp_webhook idiomas API error ' . $url . ' status=' . $resp->getStatusCode());
            return null;
        }
        $data = json_decode((string) $resp->getBody(), true);
        return is_array($data) ? $data : null;
    } catch (\Throwable $e) {
        error_log('mp_webhook idiomas API exception ' . $url . ' - ' . $e->getMessage());
        return null;
    }
}

// ─── Resolver el id de PAGO ───────────────────────────────────────────────────
$paymentId = '';
if (strpos($tipo, 'merchant_order') !== false) {
    $order = mpWebhookGet($mpClient, 'https://api.mercadopago.com/merchant_orders/' . urlencode($notifId), $mpToken);
    if (is_array($order) && !empty($order['payments'])) {
        foreach ($order['payments'] as $p) {
            if (($p['status'] ?? '') === 'approved') { $paymentId = (string) ($p['id'] ?? ''); break; }
        }
        if ($paymentId === '') {
            $last = end($order['payments']);
            $paymentId = (string) ($last['id'] ?? '');
        }
    }
} else {
    $paymentId = $notifId;
}

if ($paymentId === '') {
    http_response_code(200);
    echo json_encode(['status' => 'ignored', 'reason' => 'sin_payment_id']);
    exit;
}

// ─── Verificar el pago contra MP ──────────────────────────────────────────────
$pago = mpWebhookGet($mpClient, 'https://api.mercadopago.com/v1/payments/' . urlencode($paymentId), $mpToken);
if (!is_array($pago)) {
    http_response_code(500); // 500 → MP reintenta
    echo json_encode(['error' => 'no_se_pudo_consultar_pago', 'payment_id' => $paymentId]);
    exit;
}

if (($pago['status'] ?? '') !== 'approved') {
    http_response_code(200);
    echo json_encode(['status' => 'ignored', 'payment_status' => $pago['status'] ?? '']);
    exit;
}

// ─── Localizar la venta (external_reference = ID numérico de v2_ventas) ────────
$idVenta = (string) ($pago['external_reference'] ?? '');
if ($idVenta === '') {
    http_response_code(200);
    echo json_encode(['status' => 'ignored', 'reason' => 'sin_external_reference']);
    exit;
}

$venta = getDataPaymentByID($idVenta);
if (!$venta) {
    http_response_code(200);
    echo json_encode(['status' => 'ignored', 'reason' => 'venta_no_encontrada', 'id' => $idVenta]);
    exit;
}

// Idempotencia: si ya está DONE, no reprocesar.
if (strtoupper((string) ($venta['STATUS'] ?? '')) === 'DONE') {
    http_response_code(200);
    echo json_encode(['status' => 'already_processed']);
    exit;
}

// Marcar la venta como DONE (guardando el id de pago de MP y el payload).
try {
    $cnx = OpenCon();
    $stmt = $cnx->prepare("UPDATE `v2_ventas` SET `STATUS`='DONE', `ID_PAGO`=?, `DATA`=? WHERE `ID`=?");
    $stmt->execute([(string) ($pago['id'] ?? $paymentId), json_encode($pago), $idVenta]);
} catch (\Throwable $e) {
    error_log('mp_webhook idiomas UPDATE v2_ventas falló: ' . $e->getMessage());
}

// ─── Alta en la Academia (idempotente) ────────────────────────────────────────
$cursosAcademia = array_merge(
    [$venta['PRODUCTO']],
    explode('|', (string) $venta['UPSELL'])
);
$montoVenta  = $pago['transaction_amount'] ?? $venta['MONTO'];
$monedaVenta = strtoupper((string) ($pago['currency_id'] ?? $venta['MONEDA'] ?? 'ARS'));

$res = enviarAltaAcademia(
    $venta['CORREO'],
    $venta['NOMBRE'],
    $cursosAcademia,
    $montoVenta,
    $monedaVenta,
    'mercadopago'
);

http_response_code(200);
echo json_encode(['status' => 'ok', 'academia' => $res['code'] ?? 0]);
