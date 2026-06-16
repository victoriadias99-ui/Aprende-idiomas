<?php
/**
 * realizarVentaStripe.php
 * ───────────────────────
 * Crea una Stripe Checkout Session y devuelve su URL (echo $session->url).
 * Mismo mecanismo que aprende-excel: el form hace GET y redirige a la URL.
 *
 * Clave secreta de Stripe: se toma de la env var STRIPE_SECRET_KEY (Railway)
 * y, como respaldo, de la columna cursos_detalle.STRIPE_SECRET_KEY.
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

include("../a-includes/conexion.php");
include("../a-includes/class.autonum.php");
require_once dirname(__DIR__) . '/a-includes/logicprecios.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');

$curso     = isset($_GET['curso'])     ? trim($_GET['curso'])     : '';
$pack      = isset($_GET['pack'])      ? trim($_GET['pack'])      : $curso;
$nombre    = isset($_GET['nombre'])    ? trim($_GET['nombre'])    : '';
$apellido  = isset($_GET['apellido'])  ? trim($_GET['apellido'])  : '';
$celular   = isset($_GET['celular'])   ? trim($_GET['celular'])   : '';
$email     = isset($_GET['email'])     ? trim($_GET['email'])     : '';
$descuento = isset($_GET['descuento']) ? trim($_GET['descuento']) : '';
$dir       = isset($_GET['dir'])       ? trim($_GET['dir'])       : '';

// Moneda y país del visitante (enviados desde el form) — fallback ARS/AR
$monedaIn  = isset($_GET['moneda'])  ? strtoupper(trim($_GET['moneda']))  : 'ARS';
$countryIn = isset($_GET['country']) ? strtoupper(trim($_GET['country'])) : 'AR';

// El campo "pack" puede traer upsells: "curso|upsell1|...". El primer segmento
// es el curso real (idiomas vende un curso por checkout).
$packParts = array_values(array_filter(array_map('trim', explode('|', $pack))));
if (!empty($packParts) && !empty($packParts[0])) {
    $curso = $packParts[0];
}

if (empty($curso) || empty($email)) {
    echo 'error:datos_incompletos';
    exit;
}

$urlRoot   = 'https://' . $_SERVER['HTTP_HOST'] . '/';
$dirLimpio = trim(str_replace('../', '', $dir), '/');
$urlcurso  = !empty($dirLimpio) ? $urlRoot . $dirLimpio . '/' : $urlRoot;
$dominio   = str_replace('www.', '', $_SERVER['HTTP_HOST']);

try {
    $cnx = OpenCon();

    // 1. Datos del curso (esquema simple cursos_detalle)
    $stmt = $cnx->prepare("SELECT * FROM cursos_detalle WHERE CURSO = ?");
    $stmt->bindValue(1, $curso, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        echo 'error:curso_no_encontrado';
        exit;
    }

    $precioBase = $rows[0]['PRECIO_UNITARIO'];

    // ─── Multi-moneda Stripe ──────────────────────────────────────────────
    $stripeSupported = [
        'ARS','BOB','BRL','CLP','COP','CRC','DOP','EUR',
        'GTQ','HNL','MXN','NIO','PAB','PEN','PYG','USD','UYU',
    ];
    $stripeZeroDecimal = [
        'BIF','CLP','DJF','GNF','ISK','JPY','KMF','KRW','MGA',
        'PYG','RWF','UGX','VND','VUV','XAF','XOF','XPF',
    ];

    if (in_array($monedaIn, $stripeSupported, true)) {
        $monedaStripe       = $monedaIn;
        $precioMonedaStripe = convertirPrecioNumerico($precioBase, $monedaStripe);
    } else {
        $monedaStripe       = 'USD';
        $precioMonedaStripe = convertirPrecioNumerico($precioBase, 'USD');
    }
    $isZeroDecimal     = in_array($monedaStripe, $stripeZeroDecimal, true);
    $factorStripe      = $isZeroDecimal ? 1 : 100;
    $unitAmount        = intval(round($precioMonedaStripe * $factorStripe));
    $monedaStripeLower = strtolower($monedaStripe);

    // 2. Clave Stripe: env var primero, luego columna de la BD.
    $stripeSecretRaw = getenv('STRIPE_SECRET_KEY');
    if ($stripeSecretRaw === false || $stripeSecretRaw === '') {
        $stripeSecretRaw = $rows[0]['STRIPE_SECRET_KEY'] ?? '';
    }
    if (empty($stripeSecretRaw)) {
        error_log('realizarVentaStripe: STRIPE_SECRET_KEY vacío (env y BD) para curso ' . $curso);
        echo 'error:stripe_key_missing';
        exit;
    }

    // Soporta clave como JSON por dominio: {"aprende-idiomas.com":"sk_live_..."}
    if (strpos($stripeSecretRaw, '{') === false) {
        $stripeSecret = $stripeSecretRaw;
    } else {
        $decoded = json_decode($stripeSecretRaw, true);
        $stripeSecret = $decoded[$dominio] ?? reset($decoded);
    }

    \Stripe\Stripe::setApiKey($stripeSecret);

    // 3. Descuentos (cupón Stripe one-time)
    $discounts = [];
    if (!empty($descuento)) {
        $stmt2 = $cnx->prepare(
            "SELECT DESCRIPCION, PORCENTAJE FROM descuentos
             WHERE CURSO=? AND CODIGO_DESCUENTO=? AND ESTADO_ACTIVO=TRUE AND FECHA_HASTA>=DATE(NOW())"
        );
        $stmt2->execute([$curso, $descuento]);
        $rows_desc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($rows_desc)) {
            $montoDesc       = intval($precioBase * ($rows_desc[0]['PORCENTAJE'] / 100));
            $montoDescMoneda = convertirPrecioNumerico($montoDesc, $monedaStripe);
            $amountOff       = intval(round($montoDescMoneda * $factorStripe));

            if ($amountOff > 0) {
                $coupon = \Stripe\Coupon::create([
                    'amount_off' => $amountOff,
                    'currency'   => $monedaStripeLower,
                    'duration'   => 'once',
                    'name'       => $rows_desc[0]['DESCRIPCION'],
                ]);
                $discounts = [['coupon' => $coupon->id]];
            }
        }
    }

    // 4. Guardar lead en ventas (no bloquea el checkout si falla)
    $id_venta = uniqid($curso . '_');
    try {
        $auto_num = new auto_num($cnx, $curso);
        $id_venta = $auto_num->get_id();

        $stmt1 = $cnx->prepare(
            "INSERT INTO ventas
                (CURSO, ID, NOMBRE, APELLIDO, PREFIJO_CEL, CELULAR, EMAIL,
                 ESTADO_MP, PREFERENCIA_ID_MP, DOMINIO, ACCESS_TOKEN, CURSO_P)
             VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"
        );
        $stmt1->execute([
            $curso, $id_venta, $nombre, $apellido, 0, $celular, $email,
            'STRIPE_PENDING', '', $dominio, '', $curso,
        ]);
    } catch (\Throwable $eLead) {
        error_log('realizarVentaStripe: INSERT ventas falló - ' . $eLead->getMessage());
        $id_venta = uniqid($curso . '_');
    }

    // 5. Crear Stripe Checkout Session
    $sufijoIVA = ($countryIn === 'AR') ? ' (Precio + IVA)' : '';

    $lineItems = [[
        'price_data' => [
            'currency'     => $monedaStripeLower,
            'unit_amount'  => $unitAmount,
            'product_data' => [
                'name'        => $rows[0]['TITULO'],
                'description' => $rows[0]['DESCRIPCION'] . $sufijoIVA,
            ],
        ],
        'quantity' => 1,
    ]];

    $sessionParams = [
        'payment_method_types' => ['card'],
        'line_items'          => $lineItems,
        'mode'                => 'payment',
        'customer_email'      => $email,
        'client_reference_id' => $curso . '-' . $id_venta,
        'metadata'            => [
            'curso'      => $curso,
            'id_venta'   => $id_venta,
            'nombre'     => $nombre,
            'apellido'   => $apellido,
            'celular'    => $celular,
            'email'      => $email,
            'dominio'    => $dominio,
            'country'    => $countryIn,
            'moneda'     => $monedaStripe,
            'precio_ars' => $precioBase,
        ],
        'success_url' => $urlRoot . 'pago_exitoso.php?idVenta=' . $id_venta,
        'cancel_url'  => $urlcurso . 'checkout.php',
    ];

    if (!empty($discounts)) {
        $sessionParams['discounts'] = $discounts;
    }

    $session = \Stripe\Checkout\Session::create($sessionParams);

    // Guardar el Stripe Session ID en PREFERENCIA_ID_MP (nombre legacy de columna).
    // pago_exitoso.php lo usa para verificar el pago contra la API de Stripe.
    try {
        $cnx->prepare("UPDATE ventas SET PREFERENCIA_ID_MP=? WHERE CURSO=? AND ID=?")
            ->execute([$session->id, $curso, $id_venta]);
    } catch (\Throwable $eUpd) {
        error_log('realizarVentaStripe: UPDATE PREFERENCIA_ID_MP falló - ' . $eUpd->getMessage());
    }

    if (isset($_GET['test'])) {
        echo "OK\nSession: " . $session->id . "\nURL: " . $session->url;
        exit;
    }

    echo $session->url;

} catch (PDOException $e) {
    error_log('DB Error en realizarVentaStripe: ' . $e->getMessage());
    if (isset($_GET['test'])) echo 'DB Error: ' . $e->getMessage();
    else echo 'error:db_' . $e->getCode();
} catch (\Stripe\Exception\ApiErrorException $e) {
    error_log('Stripe Error en realizarVentaStripe: ' . $e->getMessage());
    if (isset($_GET['test'])) echo 'Stripe Error: ' . $e->getMessage();
    else echo 'error:stripe_' . $e->getStripeCode();
} catch (\Exception $e) {
    error_log('Error en realizarVentaStripe: ' . $e->getMessage());
    if (isset($_GET['test'])) echo 'Error: ' . $e->getMessage();
    else echo 'error:general';
}
?>
