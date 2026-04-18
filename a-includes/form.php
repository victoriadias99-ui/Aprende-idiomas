<?php ?>
<div class="border rounded p-3">
    <h4 class="text-center text-md-left color-text-oficial" ><b>¿Cómo hago para comprar? 🚀</b></h4> 
    <p class="mb-3   text-dark mt-3 lead text-center text-md-left">Es muy simple. Clickea el botón verde y recibe tu curso al instante en tu e-mail </p>
</div>
<form action="#">
    <?php
    foreach ($producto['packCodes'] as $c => $item) {
        $arrayAux = explode('|', $item['ids']);
        sort($arrayAux);
        $strSplit = implode($arrayAux);
        echo '<input style="width: 100%" id="' . $strSplit . '" value="' . $item['codigo'] . '" ' . ($test == 1 ? '' : 'hidden') . '>';
    }
    ?>
    <?= $test == 1 ? '<br>token:' : '' ?><input style="width: 100%" id="token" name="token" type="hidden">
    <?= $test == 1 ? '<br>simbolo:' : '' ?><input style="width: 100%" id="simbolo" name="simbolo" value="<?= $simbolo ?>" <?= $test == 1 ? '' : 'hidden' ?> <?= $test == 1 ? '' : 'hidden' ?>>
    <?= $test == 1 ? '<br>moneda:' : '' ?><input style="width: 100%" id="moneda" name="moneda" value="<?= $moneda ?>" <?= $test == 1 ? '' : 'hidden' ?> <?= $test == 1 ? '' : 'hidden' ?>>
    <?= $test == 1 ? '<br>pais:' : '' ?><input style="width: 100%" id="pais" name="pais" value="<?= $country ?>" <?= $test == 1 ? '' : 'hidden' ?> <?= $test == 1 ? '' : 'hidden' ?>>
    <?= $test == 1 ? '<br>curso:' : '' ?><input style="width: 100%" id="curso" value="<?= $curso ?>" <?= $test == 1 ? '' : 'hidden' ?>>
    <?= $test == 1 ? '<br>pack:' : '' ?><input style="width: 100%" id="pack" value="<?= $curso ?>" <?= $test == 1 ? '' : 'hidden' ?>>
    <?= $test == 1 ? '<br>amount:' : '' ?><input style="width: 100%" id="amount" value="<?= (isset($_GET['testprecio']) ? $_GET['testprecio'] : $valPrecioOferta) ?>" <?= $test == 1 ? '' : 'hidden' ?>/>
    <?= $test == 1 ? '<br>metodoPago:' : '' ?><input style="width: 100%" id="metodoPago" value="" <?= $test == 1 ? '' : 'hidden' ?>/>
    <a onclick="return false;" href="#" class="mt-3 hotmart-fb hotmart__button-checkout text-center" style="width: 100%">Comprar Ahora</a> 
</form>