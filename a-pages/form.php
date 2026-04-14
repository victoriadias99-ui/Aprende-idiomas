<form class="text-left" id="procederPagoForm">
    <input type="text" id="curso_principal" value="<?= $idcurso ?>" <?= (isset($_GET['test']) && $_GET['test'] == 1 ? 'style="width: 100%;"' : 'hidden')?>>
    <input type="text" id="dir" name="dir" value="<?= $curso['DIR'] ?>" <?= (isset($_GET['test']) && $_GET['test'] == 1 ? 'style="width: 100%;"' : 'hidden')?>>
    <input type="text" id="curso" name="curso" value="<?= $idcurso ?>" <?= (isset($_GET['test']) && $_GET['test'] == 1 ? 'style="width: 100%;"' : 'hidden')?>>
    <input type="text" id="amount" name="amount" value="<?= $precioDescuento ?>" <?= (isset($_GET['test']) && $_GET['test'] == 1 ? 'style="width: 100%;"' : 'hidden')?>>
    <input type="text" id="pack" value="<?= $idcurso ?>" <?= (isset($_GET['test']) && $_GET['test'] == 1 ? 'style="width: 100%;"' : 'hidden')?>>
    <div class="form">
        <div class="form-group "> <input type="text" class="form-control-lg col border" placeholder="Tu nombre*" id="nombre" name="nombre" required=""> </div>
        <div class="form-group "> <input type="text" class="form-control-lg col border" id="apellido" placeholder="Apellido*" name="apellido" required=""> </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12"> 
            <input type="text" class="form-control-lg col border" id="celular" placeholder="Whatsapp (y cód. de área)" maxlength="12" name="celular" >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            Coloca el email donde queres que llegue el curso
            <input type="email" class="form-control-lg col border" id="email" placeholder="E-mail*" name="email" required="">
            <p id="hint"></p>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            ¿Tenés un código promocional? colocalo acá

            <input type="text" class="form-control-lg col border" id="descuento" placeholder="Código" maxlength="30" name="descuento">
        </div>
    </div>
    <button type="button" id="proceder_pago" style="cursor:pointer" class="hvr-sweep-to-right w-100 py-3 border bg-success text-white">👉 Proceder con el pago</button>
    <div id="spinnerloading" class="text-center" style="display: none;">
                                    <p>Procesando tu pedido</p>
                                    <i class="fa fa-spinner w3-spin" style="font-size:64px"></i>
                                </div>
</form>