<!-- MOBILE ALERT | Direcciona a la seccion de compra y tiene el temporizador de la oferta-->
<div class="container-fluid d-lg-none m-0 p-0" id="mobile-alert">
    <div class="row m-0 p-0">
        <div class="col-12 ">
            <div class="row">
                <div class="col-auto mt-2 mx-auto text-center  small-timer">
                    <b>La oferta termina en </b><br><span id="temporizadorMobile"></span>
                </div>
            </div>      
        </div>
        <div class="col-9 col-sm-6 mx-auto py-1 m-0 p-0">
            <div class="row">
                <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="precio-antes-p m-0">Antes <span class="tachado"><span id="precio-anterior-alerta"><?= $precioCursoOficial ?></span></span></div>
                </div>
                <div class="col-6 py-2 text-center">
                    <div class="precio m-0"><?= $simbolo ?><span id="precio-nuevo-alerta"><?= $value ?></span> <?= $monedaOficial ?></div>
                </div>
            </div>
            <a href="checkout.php" class="btn btn-buy animate-hover py-2 mb-2 text-center ps-4">
                ¡Inscribirme Ahora! <i class="fas fa-chevron-right me-3 ps-2 animate-right-3"></i>
            </a>  
        </div>
    </div>
</div>
<!-- FIN MOBILE ALERT | Direcciona a la seccion de compra-->