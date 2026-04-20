<?php
if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$dirpage = '';
$_idVenta = $_GET['idVenta'];
include("a-includes/funcionsDB.php");
$venta = getVenta($_idVenta);
$producto = getCursoDetalle($venta['CURSO']);
$monto = $producto['PRECIO_UNITARIO'];

$productos = explode('|', $venta['CURSO']);
$_p = [];
foreach ($productos as $p) {
    if ($venta['CURSO_P'] != $p) {
        $upsells = getUpsells($venta['CURSO_P'], $p);
        $_p[] = [
            'id' => $upsells['ID_ABRE_PACK'],
            'precio' => $upsells['PRECIO'],
            'titulo' => $upsells['TITULO_1'],
        ];
    }
}
if (isset($_GET['test-ads'])) {
    
    echo "<pre>";
    print_r($venta);
    echo "</pre>";
    echo "<pre>";
    print_r($_p);
    echo "</pre>";

    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pago Exitoso</title>
        <?php include('a-pages/headerTMPE.php') ?>
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W3NBJXZ"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- Website Header -->
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
                                <p class="lead">Tu pago se acreditó correctamente. ¡Te damos la bienvenida a <?= $producto['TITULO'] ?>! Para ver las instrucciones, clickeá el siguiente botón</p>
                            </h1>
                            <a class="btn btn-block btn-lg py-4 btn-outline-light" style="background-color:#e6007e;" href="unirse.php?idVenta=<?= $_idVenta ?>"><b>Clickeame&nbsp;</b>👉</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include('a-pages/footer.php');
        if(isset($_GET['test-ads'])){
            
        } else {
        ?>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('event', 'purchase', {

                'transaction_id': '<?= $_idVenta; ?>',
                'value': <?= $monto; ?>,
                'currency': 'ARS',
                'items': [
<?php
$productoD = getCursoDetalle($venta['CURSO_P']);
?>
                        {
                            'item_name': '<?= $productoD['TITULO'] ?>',
                            'item_id': '<?= $productoD['CURSO'] ?>',
                            'price': <?= $productoD['PRECIO_UNITARIO'] ?>,
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
                value: <?= $monto ?>,
                currency: 'ARS',
            }, {'eventID': '<?= $venta['CURSO'] . '-' . $_idVenta ?>'});
        </script>
        <script>
            fbq('trackCustom', 'pago-exitoso');
        </script>
        <script>
            pintrk('track', 'checkout', {
                value: <?= $monto ?>,
                order_quantity: 1,
                currency: 'ARS',
            });
        </script>
        <?php  } ?>
    </body>
</html>