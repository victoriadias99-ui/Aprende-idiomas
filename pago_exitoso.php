<?php
if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

/* ───────────────────────────────────────────────────────────────────────────
 * Flujo Stripe simple (igual que aprende-excel): pago_exitoso.php?idVenta=XXX
 * Verifica el pago contra Stripe y muestra el acceso. Hace exit antes del
 * include v2 para no duplicar funciones (funcionsDB vs funcionsDBStripe).
 * ─────────────────────────────────────────────────────────────────────────── */
if (isset($_GET['idVenta'])) {
    ini_set('display_errors', 0);

    $_idVenta = trim($_GET['idVenta']);
    if ($_idVenta === '' || !preg_match('/^[A-Za-z0-9_\-]+$/', $_idVenta)) {
        http_response_code(400);
        exit('Bad request');
    }

    include("a-includes/funcionsDB.php");
    $venta = getVenta($_idVenta);
    if (!$venta) { http_response_code(404); exit('Not found'); }
    $producto = getCursoDetalle($venta['CURSO']);
    if (!$producto) { http_response_code(404); exit('Not found'); }

    $monto   = $producto['PRECIO_UNITARIO'];
    $moneda  = 'ARS';
    $eventId = $venta['CURSO'] . '_' . $_idVenta;

    // Verificar contra Stripe que el pago esté realmente pagado (evita IDOR).
    $pagoVerificado = false;
    try {
        require_once __DIR__ . '/a-libraries/vendor/autoload.php';

        $stripeSecret = getenv('STRIPE_SECRET_KEY_IDIOMAS');
        if ($stripeSecret === false || $stripeSecret === '') {
            $stripeSecret = getenv('STRIPE_SECRET_KEY');
        }
        if ($stripeSecret === false || $stripeSecret === '') {
            $raw = $producto['STRIPE_SECRET_KEY'] ?? '';
            if ($raw !== '' && strpos($raw, '{') !== false) {
                $host = strtolower(str_replace('www.', '', $_SERVER['HTTP_HOST'] ?? ''));
                $dec  = json_decode($raw, true);
                $stripeSecret = $dec[$host] ?? (is_array($dec) ? reset($dec) : '');
            } else {
                $stripeSecret = $raw;
            }
        }

        if ($stripeSecret && !empty($venta['PREFERENCIA_ID_MP']) && strpos($venta['PREFERENCIA_ID_MP'], 'cs_') === 0) {
            \Stripe\Stripe::setApiKey($stripeSecret);
            $session = \Stripe\Checkout\Session::retrieve($venta['PREFERENCIA_ID_MP']);
            $pagoVerificado = isset($session->payment_status) && $session->payment_status === 'paid';
            if ($pagoVerificado) {
                $zeroDec = ['bif','clp','djf','gnf','isk','jpy','kmf','krw','mga','pyg','rwf','ugx','vnd','vuv','xaf','xof','xpf'];
                $divisor = in_array(strtolower($session->currency), $zeroDec, true) ? 1 : 100;
                $monto   = $session->amount_total / $divisor;
                $moneda  = strtoupper($session->currency);
            }
        }
        if (!$pagoVerificado && !empty($venta['ESTADO_MP']) && $venta['ESTADO_MP'] === 'approved') {
            $pagoVerificado = true;
        }
    } catch (\Exception $e) {
        error_log('pago_exitoso idVenta stripe retrieve error: ' . $e->getMessage());
    }

    if (!$pagoVerificado) {
        http_response_code(402);
        exit('Pago pendiente de confirmación. Si ya pagaste, esperá unos segundos y recargá la página.');
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Pago exitoso!</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;background:#f4f5f9;color:#222;margin:0}
        .wrap{max-width:620px;margin:0 auto;padding:60px 20px;text-align:center}
        .card{background:#fff;border-radius:16px;box-shadow:0 12px 40px rgba(0,0,0,.08);padding:48px 32px}
        h1{font-size:1.9rem;margin:.2em 0}
        p{font-size:1.05rem;line-height:1.6;color:#444}
        .btn{display:inline-block;margin-top:24px;background:#e6007e;color:#fff;text-decoration:none;
             padding:16px 32px;border-radius:10px;font-weight:bold;font-size:1.1rem}
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card">
            <div style="font-size:3rem">🙌</div>
            <h1>¡Listo! Tu pago se acreditó</h1>
            <p>¡Te damos la bienvenida a <strong><?= htmlspecialchars($producto['TITULO'], ENT_QUOTES, 'UTF-8') ?></strong>!<br>
               El acceso al curso llegará a tu e-mail en los próximos minutos. Si no lo ves, revisá la carpeta de spam/no deseados.</p>
            <a class="btn" href="https://academia.aprende-idiomas.com/">Ir a la Academia 👉</a>
        </div>
    </div>
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init','851421198669354');
        fbq('track','PageView');
        fbq('track','Purchase',{value:<?= json_encode((float)$monto) ?>,currency:<?= json_encode($moneda) ?>,content_ids:[<?= json_encode($producto['CURSO']) ?>],content_name:<?= json_encode($producto['TITULO']) ?>,content_type:'product'},{eventID:<?= json_encode($eventId) ?>});
    </script>
</body>
</html>
    <?php
    exit;
}

include("a-includes/funcionsDBStripe.php");

$titulo = 'Pago exitoso';
$dirpage = '';

// Validacion de params: si falta id, la pagina se accedio sin venta real
$_idVenta = isset($_GET['id']) ? $_GET['id'] : null;
$_moneda = isset($_GET['moneda']) ? $_GET['moneda'] : 'ARS';
if (!$_idVenta) {
    header('Location: /');
    exit;
}
$venta = getDataPaymentByID($_idVenta);
if (!$venta) {
    header('Location: /');
    exit;
}
$producto = getDataProducto($venta['PRODUCTO'], $_moneda)['producto'];

// ─── Red de seguridad: alta en la academia desde la página de éxito ──────
// El alta principal corre en el webhook de Stripe (pagostripenotif.php). Si el
// webhook falló, se demoró o no llegó, acá disparamos el MISMO alta idempotente
// para que el comprador SIEMPRE reciba las credenciales (es la página que ve
// siempre tras pagar). Verificamos el pago contra Stripe antes de crear nada
// para no dar de alta sobre una venta sin pago real (IDOR). Idempotente: si el
// usuario ya existe solo suma el curso y no reenvía credenciales.
try {
    $esMP   = isset($venta['TIPO_PAGO']) && strtolower($venta['TIPO_PAGO']) === 'mercadopago';
    $yaDone = isset($venta['STATUS']) && strtoupper($venta['STATUS']) === 'DONE';

    if ($esMP) {
        // ─── MercadoPago: red de seguridad ───────────────────────────────────
        // Si el webhook (mp_webhook.php) ya marcó la venta DONE, NO reprocesamos
        // (evita duplicar la venta en la Academia). Si todavía no llegó, acá
        // verificamos el pago contra MP por external_reference y damos el alta.
        if (!$yaDone) {
            $mpToken  = getenv('MP_ACCESS_TOKEN_IDIOMAS') ?: (getenv('MP_ACCESS_TOKEN') ?: '');
            $aprobado = false;
            if ($mpToken !== '') {
                require_once __DIR__ . '/a-libraries/vendor/autoload.php';
                $mpClient = new \GuzzleHttp\Client(['timeout' => 8, 'http_errors' => false]);
                $resp = $mpClient->get('https://api.mercadopago.com/v1/payments/search', [
                    'headers' => ['Authorization' => 'Bearer ' . $mpToken],
                    'query'   => ['external_reference' => (string) $venta['ID'], 'sort' => 'date_created', 'criteria' => 'desc'],
                ]);
                $mpData = json_decode((string) $resp->getBody(), true);
                foreach (($mpData['results'] ?? []) as $p) {
                    if (($p['status'] ?? '') === 'approved') { $aprobado = true; break; }
                }
            }
            if ($aprobado) {
                // Reclamo atómico: solo damos el alta si NADIE marcó DONE antes
                // (evita doble alta con el webhook → dos contraseñas distintas).
                $reclamado = true;
                try {
                    $cnxMp = OpenCon();
                    $claim = $cnxMp->prepare("UPDATE `v2_ventas` SET `STATUS`='DONE' WHERE `ID`=? AND COALESCE(`STATUS`,'') <> 'DONE'");
                    $claim->execute([$venta['ID']]);
                    $reclamado = $claim->rowCount() > 0;
                } catch (\Throwable $e) { /* ante error de DB, intentamos el alta igual */ }
                if ($reclamado) {
                    $cursosAcademia = array_merge([$venta['PRODUCTO']], explode('|', (string) $venta['UPSELL']));
                    enviarAltaAcademia($venta['CORREO'], $venta['NOMBRE'], $cursosAcademia, $venta['MONTO'], $venta['MONEDA'], 'mercadopago');
                }
            }
        }
    } else {
        // ─── Stripe (comportamiento original) ────────────────────────────────
        $pagado = $yaDone;

        if (!$pagado) {
            $sessionId = '';
            if (!empty($venta['DATA'])) {
                $dataObj = json_decode($venta['DATA']);
                if (isset($dataObj->id) && strpos((string) $dataObj->id, 'cs_') === 0) {
                    $sessionId = $dataObj->id;
                }
            }
            $stripeSecret = ($producto['live'] == 1)
                ? ($producto['keySecretStripe'] ?? '')
                : ($producto['keySecretStripeTest'] ?? '');

            if ($sessionId !== '' && $stripeSecret) {
                require_once __DIR__ . '/a-libraries/vendor/autoload.php';
                \Stripe\Stripe::setApiKey($stripeSecret);
                $session = \Stripe\Checkout\Session::retrieve($sessionId);
                $pagado = isset($session->payment_status) && $session->payment_status === 'paid';
            }
        }

        if ($pagado) {
            $cursosAcademia = array_merge(
                [$venta['PRODUCTO']],
                explode('|', (string) $venta['UPSELL'])
            );
            enviarAltaAcademia(
                $venta['CORREO'],
                $venta['NOMBRE'],
                $cursosAcademia,
                $venta['MONTO'],
                $venta['MONEDA']
            );
        }
    }
} catch (\Throwable $e) {
    error_log('[pago_exitoso alta academia] ' . $e->getMessage());
}

$productoUSD = getDataProducto($venta['PRODUCTO'], 'USD')['producto'];
$totalUSD = $productoUSD['PRECIO_DESC'];
$total = $producto['PRECIO_DESC'];
$upsell = [];

// Inicializadas SIEMPRE: en compras SIN upsell estas variables quedaban
// indefinidas y reventaban el foreach($_p) y el tracking ($productoCheckout)
// de más abajo → página en blanco bajo PHP 8.
$_p = [];
$productoCheckout = getDataProductoCheckout($venta['PRODUCTO'], $_moneda);

if ($venta['UPSELL'] != $venta['PRODUCTO']) {
    $upsell = explode('|', $venta['UPSELL']);
    foreach (($productoCheckout['pack'] ?? []) as $item) {
        if (in_array($item['ID_ABRE'], $upsell)) {
            $total += $item['PRECIO'];
            $_p[] = [
                'id' => $item['ID_ABRE'],
                'precio' => $item['PRECIO'],
                'titulo' => $item['NOMBRE'],
            ];
        }
    }
}

if (isset($_GET['test'])) {
    echo "<pre style='background-color: white;'>";
    print_r($productoCheckout);
    echo "</pre>";
}

if (isset($_GET['test'])) {
    
    echo "<pre>";
    print_r($venta);
    echo "</pre>";
    
    echo "<pre>";
    print_r($_p);
    echo "</pre>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pago Exitoso</title>
        <?php include('a-pages/header.php') ?>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-2 col-sm-6 col-6 logo">
                        <img src="/ingles-nivel-uno/img/logo2.png" alt="logo" class="img-fluid">
                    </div>
                    <div class="col-md-3 hdphone">
                        <p> </p>
                    </div>
                    <div class="col-md-3 hdphone">
                        <img src="/ingles-nivel-uno/img/security.png" alt="security" class="img-fluid">
                    </div>
                    <div class="col-md-1 gr-logo"></div>
                    <div class="col-md-3 cta-button  col-sm-6 col-6">
                    </div>
                </div>
            </div>
        </header>

        <!-- Top Product Banner -->
        <section class="top-product">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-5">
                        <div class="product-img">
                            <img src="/ingles-nivel-uno/img/ingles-producto2.jpg" class="img-fluid" alt="product">
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="section-heading">
                            <h1 class="mt-5 text-dark pt-5"><b>¡Listo!&nbsp;&nbsp;</b>🙌
                                <hr>
                                <p class="lead">Tu pago se acreditó correctamente. ¡Te damos la bienvenida a <?= $producto['TITULO'] ?>!</p>
                            </h1>
                            <p class="mb-3   mt-4 lead">El curso llegará a tu e-mail dentro de los próximos 5 minutos. Si no lo encuentras, revisa la sección no deseados/spam/otros</p>
                            <div class=" mx-auto text-center mt-5">

                                <div>
                                    <a class="btn btn-block btn-lg btn-outline-light" style="background-color:#e6007e;" href="https://academia.aprende-idiomas.com/"><b>Ver el curso</b>👉</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include('a-pages/footer.php') ?>
                <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('event', 'purchase', {
                'transaction_id': '<?= $venta['ID']; ?>',
                'value': <?=  $total; ?>,
                'currency': '<?= $_GET['moneda']; ?>',
                'items': [
                        {
                            'item_name': '<?= $productoCheckout['producto']['NOMBRE'] ?>',
                            'item_id': '<?= $productoCheckout['producto']['ID_ABRE'] ?>',
                            'price': <?= $productoCheckout['producto']['PRECIO_DESC'] ?>,
                            'quantity': 1
                        },
<?php 
foreach ($_p as $prod):
    ?>
                        {
                            'item_name': '<?= $prod['titulo'] ?>',
                            'item_id': '<?= $prod['id'] ?>',
                            'price': <?= $prod['precio'] ?>,
                            'quantity': 1
                        },
<?php endforeach; ?>
                ]
            });
        </script>

        <script>
            fbq('track', 'Purchase', {
                value: <?= $total ?>,
                currency: '<?= $_GET['moneda'] ?>'
            }, {eventID: '<?= $venta['ID'] ?>'});
        </script>
        <script>
            fbq('trackCustom', 'pago-exitoso', {eventID: '<?= $venta['ID'] ?>'});
        </script>
    </body>
</html>