<?php
if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

include("a-includes/funcionsDBStripe.php");

$titulo = 'Pago exitoso';
$dirpage = '';
$venta = getDataPaymentByID($_GET['id']);
$producto = getDataProducto($venta['PRODUCTO'], $_GET['moneda'])['producto'];
$productoUSD = getDataProducto($venta['PRODUCTO'], 'USD')['producto'];
$totalUSD = $productoUSD['PRECIO_DESC'];
$total = $producto['PRECIO_DESC'];
$upsell = [];

if ($venta['UPSELL'] != $venta['PRODUCTO']) {
    $upsell = explode('|', $venta['UPSELL']);
    $productoCheckout = getDataProductoCheckout($venta['PRODUCTO'], $_GET['moneda']);
    foreach ($productoCheckout['pack'] as $item) {
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