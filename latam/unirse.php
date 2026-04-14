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
$urlGrupos = [];
$pos = strpos($producto['URL_FACEBOOK_GROUP'], '{');
if($pos === false){ //Es una url
    $jsonUrlGrupos[$producto['TITULO']] = $producto['URL_FACEBOOK_GROUP'];
} else { // Es un json
    $jsonUrlGrupos = json_decode($producto['URL_FACEBOOK_GROUP'], true);
}
if (isset($_GET['test'])) {
    echo "<pre>";
    print_r($venta);
    echo "</pre>";
    echo "<pre>";
    print_r($producto);
    echo "</pre>";
    echo "<pre>";
    print_r($jsonUrlGrupos);
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
                            <h1 class="text-body mt-5 pt-5">Ok... y ahora?</h1>
                            <hr>
                        </div>
                        <p class="lead mt-5" style=""><b>Leer con atención:</b></p>
                        <p class="">📧 En minutos vas a recibir un e-mail. Allí vas a ver las instrucciones para descargar el curso (si no lo encontrás, revisá la sección No Deseados/Spam)<br></p>
                        <h4 class="mt-5">✅ ¡Novedad!</h4>
                        <p class="">Para ver el curso debes ingresar a nuestra academia <a href="https://academia.aprende-idiomas.com/">Ingresar</a> con tu correo. All� se encuentran todos los videos para que puedas cursar :).</p>

                        <hr>
                        <?php
                        foreach ($jsonUrlGrupos as $key => $value){
                            echo '<a class="btn btn-block btn-lg py-4 btn-outline-light" target="_blank" style="background-color:#e6007e;" href="' . $value . '"><b>EMPEZAR EL CURSO "' . strtoupper($key) . '" &nbsp;</b>👉</a>';
                        }
                        ?>
                        <p class="">Una vez enviada la solicitud de ingreso al grupo, puede tomar hasta 24hs tu aprobación. Para acelerar el proceso respondé el e-mail que te enviamos lo antes posible.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <?php include('a-pages/footer.php') ?>
    </body>

</html>