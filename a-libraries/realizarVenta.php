<?php
if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
// SDK de Mercado Pago

require_once dirname(__DIR__) . '/a-libraries/vendor/autoload.php';

include("ApiFacebookEvents.php");

include("../a-includes/conexion.php");
include("../a-includes/class.autonum.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');
$cursoP = $_GET['curso'];
$curso = $_GET['curso'];
$pack = isset($_GET['pack']) ? $_GET['pack'] : $curso;
if($curso != $pack){
    $curso = $pack;
}
$dir = $_GET['dir'];

$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$prefijo_cel = 0;
$celular = $_GET['celular'];
$email = $_GET['email'];
$descuento = $_GET['descuento'];

$urlcurso = 'https://' . $_SERVER['HTTP_HOST'] . '/' . $dir . '/';
$urlRoot = 'https://' . $_SERVER['HTTP_HOST'] . '/';
$urlLib = 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/';

if (isset($_GET['test'])) {
    echo '$urlcurso = ' . $urlcurso . '<br>';
    echo '$urlRoot = ' . $urlRoot . '<br>';
    echo '$urlLib = ' . $urlLib . '<br>';
}

if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$ip = explode(',', str_replace(' ', '', $ip))[0];

try {
    $cnx = OpenCon();
    $stmt = $cnx->prepare("UPDATE `ip_visita` SET `correo` = ? WHERE `ip` = ? AND `id_producto` = ?");
    $stmt->bindValue(1, $email, PDO::PARAM_STR);
    $stmt->bindValue(2, $ip, PDO::PARAM_STR);
    $stmt->bindValue(3, $_GET['curso'], PDO::PARAM_STR);
    $stmt->execute();

    $auto_num = new auto_num($cnx, $curso);
    $id_venta = $auto_num->get_id();
    // Crea un ítem en la preferencia    

    $consulta = "SELECT TITULO,DESCRIPCION,PRECIO_UNITARIO,PUBLIC_KEY_MP,ACCESS_TOKEN_MP FROM cursos_detalle WHERE CURSO = ?";
    if (isset($_GET['test']))
        echo "SELECT TITULO,DESCRIPCION,PRECIO_UNITARIO,PUBLIC_KEY_MP,ACCESS_TOKEN_MP FROM cursos_detalle WHERE CURSO = '" . $curso . "'<br>";
    //die();
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $curso, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['test'])) {
        echo "<pre>";
        print_r($rows);
        echo "</pre>";
    }

    $pagoTotal = 0;
    //Agrega credenciales
    //MercadoPago\SDK::setClientId("testga");
    $__url = '';
    $ACCESS_TOKEN_MP = '';
    if (strpos($rows[0]['ACCESS_TOKEN_MP'], '{') === false) {
        MercadoPago\SDK::setAccessToken($rows[0]['ACCESS_TOKEN_MP']);
    } else {
        if (isset($_GET['test'])) {
            $__url = str_replace('www.', '', $_SERVER['HTTP_HOST']);
            echo $__url . '<br>';
            $ACCESS_TOKEN_MP = get_object_vars(json_decode($rows[0]['ACCESS_TOKEN_MP']))[$__url];
            echo $ACCESS_TOKEN_MP . '<br>';
        }
        $__url = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $ACCESS_TOKEN_MP = get_object_vars(json_decode($rows[0]['ACCESS_TOKEN_MP']))[$__url];
        MercadoPago\SDK::setAccessToken($ACCESS_TOKEN_MP);
    }

    $item = new MercadoPago\Item();
    $item->id = "P0001";
    $item->title = $rows[0]['TITULO'];
    $item->quantity = 1;
    $item->description = $rows[0]['DESCRIPCION'];
    $item->currency_id = "ARS";
    $item->unit_price = $pagoTotal = $rows[0]['PRECIO_UNITARIO'];
    $item->picture_url = $urlRoot . "a-img/logojpg.jpg";

    // Crea un ítem en la preferencia
    $payer = new MercadoPago\Payer();
    $payer->name = $nombre;
    $payer->surname = $apellido;
    $payer->email = $email;

    $payer->phone = array(
        "area_code" => $prefijo_cel,
        "number" => $celular
    );
    //S$payer->date_created = "2018-06-02T12:58:41.425-04:00";
    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();

    //Descuentos
    $consulta_desc = "SELECT DESCRIPCION, PORCENTAJE FROM descuentos WHERE CURSO=? AND CODIGO_DESCUENTO=? AND ESTADO_ACTIVO=TRUE AND FECHA_HASTA>=DATE(NOW())";
    $stmt2 = $cnx->prepare($consulta_desc);
    $stmt2->bindValue(1, $curso, PDO::PARAM_STR);
    $stmt2->bindValue(2, $descuento, PDO::PARAM_STR);
    $stmt2->execute();
    $rows_descuento = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows_descuento) > 0) {
        $itemdesc = new MercadoPago\Item();
        $itemdesc->id = "P0002";
        $itemdesc->title = $rows_descuento[0]['DESCRIPCION'];
        $itemdesc->quantity = 1;
        $itemdesc->description = $rows_descuento[0]['DESCRIPCION'];
        $itemdesc->currency_id = "ARS";
        $itemdesc->unit_price = $pagoTotal = (($rows[0]['PRECIO_UNITARIO'] * ($rows_descuento[0]['PORCENTAJE'] / 100)) * -1);
        $itemdesc->picture_url = $urlRoot . "a-img/logowhite.jpg";
    }


    if (count($rows_descuento) > 0) {
        $itemsarr = array($item, $itemdesc);
        $preference->items = $itemsarr;
    } else {
        $preference->items = array($item);
    }

    if (isset($_GET['test'])) {
        echo $urlLib . "IPN_mp.php?curso=$curso<br>";
    }

    $preference->payer = $payer;
    $preference->binary_mode = false;
    $preference->external_reference = $curso . "-" . $id_venta;
    $preference->notification_url = $urlRoot . "a-libraries/IPN_mp.php?curso=$curso";//$urlLib . "IPN_mp.php?curso=$curso";
    $preference->payment_methods = array(
        "excluded_payment_methods" => array(array("id" => "rapipago"), array("id" => "pagofacil")),
        "excluded_payment_types" => array(array("id" => "ticket")));

    $preference->back_urls = array(
        "success" => $urlRoot . "pago_exitoso.php?monto=" . $pagoTotal . '&idVenta=' . $id_venta,
        "failure" => $urlcurso . "checkout.php",
        "pending" => $urlRoot . "pago_en_proceso.php?monto=" . $pagoTotal);

    if (isset($_GET['test'])) {
        echo 'success = ' . $urlRoot . "pago_exitoso.php?monto=" . $pagoTotal . '&idVenta=' . $id_venta . '<br>';
        echo 'failure = ' . $urlcurso . "checkout.php" . '<br>';
        echo 'pending = ' . $urlRoot . "pago_en_proceso.php?monto=" . $pagoTotal . '<br>';
    }


    $preference->auto_return = "approved";
    $preference->tracks = array(
        array(
            'type' => 'facebook_ad',
            'values' => array(
                'pixel_id' => '2383917851890090'
            )
        )
    );
    $preference_created = $preference->save();
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$cnx->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


$stmt1 = $cnx->prepare("INSERT INTO ventas (CURSO, ID,NOMBRE, APELLIDO, PREFIJO_CEL, CELULAR, EMAIL,ESTADO_MP,PREFERENCIA_ID_MP,DOMINIO,ACCESS_TOKEN,CURSO_P) "
        . "VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt1->bindValue(1, $curso, PDO::PARAM_STR);
$stmt1->bindValue(2, $id_venta, PDO::PARAM_STR);
$stmt1->bindValue(3, $nombre, PDO::PARAM_STR);
$stmt1->bindValue(4, $apellido, PDO::PARAM_STR);
$stmt1->bindValue(5, $prefijo_cel, PDO::PARAM_INT);
$stmt1->bindValue(6, $celular, PDO::PARAM_STR);
$stmt1->bindValue(7, $email, PDO::PARAM_STR);
$stmt1->bindValue(8, ' ', PDO::PARAM_STR);
$stmt1->bindValue(9, $preference->id, PDO::PARAM_STR);
$stmt1->bindValue(10, $__url, PDO::PARAM_STR);
$stmt1->bindValue(11, $ACCESS_TOKEN_MP, PDO::PARAM_STR);
$stmt1->bindValue(12, $cursoP, PDO::PARAM_STR);

$stmt1->execute();

ApiFacebookEventsFunciones::initPaymentSendDataInitPaymentFacebook($email, $pagoTotal, 'ARS', $urlcurso);
if ($stmt1->rowCount() > 0) {

    echo $preference->init_point;
}
?>