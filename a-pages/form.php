<?php ?>
 <div class="col-md-10 mx-auto text-dark rounded pb-5 py-5 px-md-4 px-xs-2 px-sm-2  bg-white mt-3" >
<style>
    .btn-payment-cuadrado {
        font-size: 1em;
        width: 50%;
        height: 72px;
        border-radius: 4px;
        border: 2px solid #dfe1e6;
        background: #ffffff30;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        transition: all .3s ease 0s;
        cursor: pointer;
        pointer-events: auto;
    }

    .btn-payment-cuadrado img {
        height: 20px;
        margin-right: 5px;
    }
</style>
<div class="pt-40 pb-40 px-30 radius20 holder bg-gray text-dark">
    <form class="text-center" id="procederPagoForm">
        <div class="row ">
        <div class="mb-35 d-flex flex-wrap justify-content-between align-items-center">
            <img src="../img/credit-cards-footer.png" alt="Métodos de pago aceptados" class="img-fluid mx-auto" style="max-height:32px;opacity:.85">

<h5 class="mx-auto pb-md-3 mt-4 text-center" style="font-family: montserrat_bold;"><i class="fas fa-arrow-alt-circle-right text-success blink"></i><b> ¿Dónde querés recibir el curso?</b></h5>        </div>
        </div>
        <div class="row ">
            <?php
            foreach ($producto['packCodes'] as $c => $item) {
                echo '<input style="width: 100%" id="' . str_replace('|', '', $item['ids']) . '" value="' . $item['codigo'] . '" ' . ($test == 1 ? '' : 'hidden') . '>';
            }
            ?>
            <?= $test == 1 ? '<br>stripekeypublic:' : '' ?><input style="width: 100%" id="stripekeypublic" name="stripekeypublic" value="<?= $producto['producto']['live'] == 1 ? $producto['producto']['keyPublicStripe'] : $producto['producto']['keyPublicStripeTest'] ?>" <?= $test == 1 ? '' : 'hidden' ?> <?= $test == 1 ? '' : 'hidden' ?>>
            <?= $test == 1 ? '<br>token:' : '' ?><input style="width: 100%" id="token" name="token" type="hidden">
            <?= $test == 1 ? '<br>simbolo:' : '' ?><input style="width: 100%" id="simbolo" name="simbolo" value="<?= $simbolo ?>" <?= $test == 1 ? '' : 'hidden' ?> <?= $test == 1 ? '' : 'hidden' ?>>
            <?= $test == 1 ? '<br>moneda:' : '' ?><input style="width: 100%" id="moneda" name="moneda" value="<?= $moneda ?>" <?= $test == 1 ? '' : 'hidden' ?> <?= $test == 1 ? '' : 'hidden' ?>>
            <?= $test == 1 ? '<br>pais:' : '' ?><input style="width: 100%" id="pais" name="pais" value="<?= $country ?>" <?= $test == 1 ? '' : 'hidden' ?> <?= $test == 1 ? '' : 'hidden' ?>>
            <?= $test == 1 ? '<br>curso:' : '' ?><input style="width: 100%" id="curso" value="<?= $curso ?>" <?= $test == 1 ? '' : 'hidden' ?>>
            <?= $test == 1 ? '<br>pack:' : '' ?><input style="width: 100%" id="pack" value="<?= $curso ?>" <?= $test == 1 ? '' : 'hidden' ?>>
            <?= $test == 1 ? '<br>amount:' : '' ?><input style="width: 100%" id="amount" value="<?= htmlspecialchars((string)(isset($_GET['testprecio']) ? $_GET['testprecio'] : $valPrecioOferta), ENT_QUOTES, 'UTF-8') ?>" <?= $test == 1 ? '' : 'hidden' ?>/>
            <?= $test == 1 ? '<br>metodoPago:' : '' ?><input style="width: 100%" id="metodoPago" value="" <?= $test == 1 ? '' : 'hidden' ?>/>
            
            
            
        <div class="form-group col-12"> <input type="text" class="form-control-lg col border" placeholder="Tu nombre*" id="nombre" name="nombre" required=""> </div>
        <div class="form-group col-12"> <input type="text" class="form-control-lg col border" id="apellido" placeholder="Apellido*" name="apellido" required=""> </div>
   
    <div class="form-row col-12">
        <div class="form-group col-12">
            Coloca el email donde queres que llegue el curso
            <input type="email" class="form-control-lg col border" id="email" placeholder="E-mail*" name="email" required="">
            <p id="hint"></p>
        </div>
    </div>
            
            

            <div id="alert-datos" class="alert alert-danger" role="alert" style="visibility: hidden; display:none;">
                Verifica tus datos
            </div>

            <div id="alert-metodo-pago" class="alert alert-danger" role="alert" style="visibility: hidden; display:none;">
                Selecciona método de pago
            </div>


        </div>

        <p class="text-left my-2">Luego de abonar, aguarda unos segundos para ser dirigido a nuestro sitio web 😊.</p>
        <button type="button" id="proceder_pago" style="cursor:pointer; background-color:#68aa21; display:none;" class="btn hvr-sweep-to-right w-100 py-3 text-white">👉 Proceder con el pago</button>
        
        <div id="div-pago" style="display:block;">
            <h5 class="mx-auto pb-md-3 text-center mt-3"><b><?= (isset($_GET['op']) && $_GET['op'] == 1) ? 'Realiza tu pago!' : 'Elige como quieres pagar' ?></b></h5> 
            <div id="espera-pagos" class="row" style="display: none">
                <div class="col">
                    <p>Espera un momento....</p>
                </div>
            </div>
            <div id="btn-pagos" class="row">
                    <?php
                    echo '<div class="col-md-12 p-0 m-md-0 ml-2 mr-2 mb-2">';
                    echo '<div style="width:100%;" id="payment-strype"  class="btn-payment-cuadrado p-1 mb-md-1">';
                    echo '<input class="check-payment" type="radio" name="opcion-pago-strype" id="id-tarjeta-payment-strype" value="strype" style="visibility: hidden; display:none;"> ';
                    echo '<span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:24px;background:linear-gradient(135deg,#ec1389,#00b6ed);border-radius:4px;font-size:.85rem;margin-right:8px;color:#fff">💳</span>';
                    echo 'Tarjeta de crédito/débito';
                    echo '</div></div>';
                    /*
                      echo '<div class="col-md-12 p-0 m-md-0 ml-2 mr-2 mb-2">';
                      echo '<div style="width:100%;" id="payment-paypal" class="btn-payment-cuadrado p-1 mb-md-1">';
                      echo '<input class="form-check-input check-payment" type="radio" name="opcion-pago-paypal" id="id-tarjeta-payment-paypal" value="paypal" style="visibility: hidden; display:none;">';
                      echo '<img src="../img/paypal.png" alt="method" class="">';
                      echo '</div></div>';

                     */
                    ?>
                </div>
        </div>
    </form>
</div>
 </div>

<script>
/* ============================================================
   Captura de lead de checkout abandonado
   Se dispara al blur del email (si válido) y al cambiar nombre/apellido.
   Debounced para no spam-ear el endpoint.
   ============================================================ */
(function(){
    var ENDPOINT = '/a-includes/capturar_lead.php';
    var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var timer = null;
    var lastPayload = null;

    function getVal(id){
        var el = document.getElementById(id);
        return el ? el.value.trim() : '';
    }

    function capture(){
        var email = getVal('email');
        if (!EMAIL_RE.test(email)) return;

        var payload = {
            email: email,
            nombre: getVal('nombre'),
            apellido: getVal('apellido'),
            curso: getVal('curso'),
            pais: getVal('pais'),
            moneda: getVal('moneda'),
            precio: parseFloat(getVal('amount')) || null,
            url: window.location.href
        };

        // Evitar enviar el mismo payload 2 veces seguidas
        var key = JSON.stringify(payload);
        if (key === lastPayload) return;
        lastPayload = key;

        // Fire and forget (no bloquea UX)
        try {
            fetch(ENDPOINT, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: key,
                keepalive: true
            }).catch(function(){ /* silent */ });
        } catch(e){ /* silent */ }
    }

    function debouncedCapture(){
        if (timer) clearTimeout(timer);
        timer = setTimeout(capture, 800);
    }

    // Escuchar blur y change en los 3 campos
    ['email','nombre','apellido'].forEach(function(id){
        var el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('blur', capture);
        el.addEventListener('change', capture);
        el.addEventListener('input', debouncedCapture);
    });

    // También capturar cuando el user sale de la página (beforeunload)
    window.addEventListener('beforeunload', function(){
        if (EMAIL_RE.test(getVal('email'))) capture();
    });
})();
</script>