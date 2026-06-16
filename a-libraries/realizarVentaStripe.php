<?php
/**
 * realizarVentaStripe.php
 * ───────────────────────
 * Crea una Stripe Checkout Session y devuelve su URL (echo $session->url).
 * El form (checkoutv4.js) hace GET y redirige a esa URL.
 *
 * Datos del curso: esquema v2 (v2_producto / v2_producto_precios) vía funcionsDBStripe.
 * Clave secreta de Stripe: env var STRIPE_SECRET_KEY_IDIOMAS (Railway), con
 * fallback a STRIPE_SECRET_KEY y a la columna keySecretStripe de la BD.
 */

// Suprimir deprecated/notices del SDK de Stripe (incompatibles con PHP 8.1+)
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ini_set('display_errors', 0);

if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

header('Content-Type: text/plain; charset=utf-8');

require_once dirname(__DIR__) . '/a-libraries/vendor/autoload.php';

// funcionsDBStripe ya incluye conexion.php, class.autonum.php y Keys.php
include("../a-includes/funcionsDBStripe.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');

$curso     = isset($_GET['curso'])     ? trim($_GET['curso'])     : '';
$pack      = isset($_GET['pack'])      ? trim($_GET['pack'])      : $curso;
$nombre    = isset($_GET['nombre'])    ? trim($_GET['nombre'])    : '';
$apellido  = isset($_GET['apellido'])  ? trim($_GET['apellido'])  : '';
$email     = isset($_GET['email'])     ? trim($_GET['email'])     : '';
$descuento = isset($_GET['descuento']) ? trim($_GET['descuento']) : '';
$dir       = isset($_GET['dir'])       ? trim($_GET['dir'])       : '';
$moneda    = isset($_GET['moneda'])    ? strtoupper(trim($_GET['moneda']))  : 'ARS';
$pais      = isset($_GET['country'])   ? strtoupper(trim($_GET['country'])) : 'AR';

if (empty($curso) || empty($email)) {
    echo 'error:datos_incompletos';
    exit;
}

$urlRoot   = 'https://' . $_SERVER['HTTP_HOST'] . '/';
$dirLimpio = trim(str_replace('../', '', $dir), '/');
$urlcurso  = !empty($dirLimpio) ? $urlRoot . $dirLimpio . '/' : $urlRoot;
$dominio   = str_replace('www.', '', $_SERVER['HTTP_HOST']);

// Stripe zero-decimal: el monto va en unidades enteras, no en centavos.
$stripeZeroDecimal = [
    'BIF','CLP','DJF','GNF','ISK','JPY','KMF','KRW','MGA',
    'PYG','RWF','UGX','VND','VUV','XAF','XOF','XPF',
];

try {
    // 1. Datos del curso (esquema v2). Igual que checkout.php: ($curso, $moneda, $pais).
    // Con fallbacks por si el precio está indexado por país, por moneda o solo en USD.
    $r = getDataProductoCheckout($curso, $moneda, $pais);
    if (empty($r['producto'])) {
        $r = getDataProductoCheckout($curso, $moneda);
    }
    if (empty($r['producto'])) {
        $r = getDataProductoCheckout($curso, 'USD');
    }
    $producto = isset($r['producto']) ? $r['producto'] : null;
    $dataPack = isset($r['pack']) ? $r['pack'] : [];

    if (empty($producto)) {
        echo 'error:curso_no_encontrado';
        exit;
    }

    $monedaStripe      = strtoupper($producto['MONEDA']);
    $monedaStripeLower = strtolower($monedaStripe);
    $factor            = in_array($monedaStripe, $stripeZeroDecimal, true) ? 1 : 100;

    // 2. Clave Stripe: env var de idiomas primero, luego genérica, luego BD.
    $stripeSecret = getenv('STRIPE_SECRET_KEY_IDIOMAS');
    if ($stripeSecret === false || $stripeSecret === '') {
        $stripeSecret = getenv('STRIPE_SECRET_KEY');
    }
    if ($stripeSecret === false || $stripeSecret === '') {
        $stripeSecret = $producto['keySecretStripe'] ?? '';
    }
    if (empty($stripeSecret)) {
        error_log('realizarVentaStripe: clave Stripe vacía para curso ' . $curso);
        echo 'error:stripe_key_missing';
        exit;
    }
    // Soporta clave JSON por dominio: {"aprende-idiomas.com":"sk_live_..."}
    if (strpos($stripeSecret, '{') !== false) {
        $dec = json_decode($stripeSecret, true);
        $stripeSecret = $dec[$dominio] ?? (is_array($dec) ? reset($dec) : $stripeSecret);
    }

    $stripe = new \Stripe\StripeClient($stripeSecret);

    // 3. Line items: curso base + upsells seleccionados en "pack".
    $lineItems = [];
    $precioTotal = floatval($producto['PRECIO_DESC']);

    $lineItems[] = [
        'price_data' => [
            'currency'     => $monedaStripeLower,
            'unit_amount'  => intval(round($producto['PRECIO_DESC'] * $factor)),
            'product_data' => ['name' => $producto['NOMBRE']],
        ],
        'quantity' => 1,
    ];

    if ($curso !== $pack) {
        $arrayPacks = explode('|', $pack);
        foreach ($dataPack as $p) {
            if (in_array($p['ID_ABRE'], $arrayPacks, true)) {
                $lineItems[] = [
                    'price_data' => [
                        'currency'     => $monedaStripeLower,
                        'unit_amount'  => intval(round($p['PRECIO'] * $factor)),
                        'product_data' => ['name' => $p['NOMBRE']],
                    ],
                    'quantity' => 1,
                ];
                $precioTotal += floatval($p['PRECIO']);
            }
        }
    }

    // 4. Guardar venta (v2_ventas) — mismo flujo que initPagos.php
    $idTemp = uniqid();
    setVentaStripe('payment-strype', $curso, $pack, $idTemp, $precioTotal, $monedaStripe, $pais, $nombre, $apellido, $email, 'pendiente', null);
    $_payment = getVentaStripe($idTemp);
    $idVenta  = $_payment ? $_payment['ID'] : $idTemp;

    // 5. Crear Stripe Checkout Session
    $sessionParams = [
        'payment_method_types' => ['card'],
        'line_items'          => $lineItems,
        'mode'                => 'payment',
        'customer_email'      => $email,
        'allow_promotion_codes' => true,
        'client_reference_id' => $curso . '-' . $idVenta,
        'metadata'            => [
            'curso'    => $curso,
            'id_venta' => $idVenta,
            'nombre'   => $nombre,
            'apellido' => $apellido,
            'email'    => $email,
            'pais'     => $pais,
            'moneda'   => $monedaStripe,
        ],
        'success_url' => $urlRoot . 'pago_exitoso.php?id=' . $idVenta . '&moneda=' . $monedaStripe,
        'cancel_url'  => $urlcurso . 'checkout.php',
    ];

    $session = $stripe->checkout->sessions->create($sessionParams);

    // Guardar el Session en la venta (DATA + ID de sesión)
    try {
        updVentaStripe($idTemp, 'payment-strype', $curso, $pack, $session->id, $precioTotal, $monedaStripe, $pais, $nombre, $apellido, $email, 'pendiente', json_encode($session));
    } catch (\Throwable $eUpd) {
        error_log('realizarVentaStripe: updVentaStripe falló - ' . $eUpd->getMessage());
    }

    if (isset($_GET['test'])) {
        echo "OK\nSession: " . $session->id . "\nURL: " . $session->url;
        exit;
    }

    echo $session->url;

} catch (\Stripe\Exception\ApiErrorException $e) {
    error_log('Stripe Error en realizarVentaStripe: ' . $e->getMessage());
    if (isset($_GET['test'])) echo 'Stripe Error: ' . $e->getMessage();
    else echo 'error:stripe_' . $e->getStripeCode();
} catch (PDOException $e) {
    error_log('DB Error en realizarVentaStripe: ' . $e->getMessage());
    if (isset($_GET['test'])) echo 'DB Error: ' . $e->getMessage();
    else echo 'error:db_' . $e->getCode();
} catch (\Throwable $e) {
    error_log('Error en realizarVentaStripe: ' . $e->getMessage());
    if (isset($_GET['test'])) echo 'Error: ' . $e->getMessage();
    else echo 'error:general';
}
?>
