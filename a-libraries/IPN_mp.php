<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '/home/aprendee/aprende-idiomas.com/a-libraries/PHPMailer-master/src/Exception.php';
require '/home/aprendee/aprende-idiomas.com/a-libraries/PHPMailer-master/src/PHPMailer.php';
require '/home/aprendee/aprende-idiomas.com/a-libraries/PHPMailer-master//src/SMTP.php';

if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require_once dirname(__DIR__) . '/a-libraries/vendor/autoload.php';

include("ApiFacebookEvents.php");

include("../a-includes/conexion.php");
include("../a-includes/class.autonum.php");

$nombre = '';
$apellido = '';
$mail = '';
$monto_acreditado = '';

$bodyReceived = file_get_contents("php://input");
$dataJson = json_decode($bodyReceived . '');

$topic = $_GET["type"];
$id = $_GET["data_id"];
$curso = $_GET["curso"];

if ($topic == 'payment') {
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $cnx = OpenCon();

    $consulta = "SELECT TITULO,DESCRIPCION,PRECIO_UNITARIO,PUBLIC_KEY_MP,ACCESS_TOKEN_MP FROM cursos_detalle WHERE CURSO = ?";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $curso, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Agrega credenciales
    //MercadoPago\SDK::setClientId("testga");
    $__url = '';
    $ACCESS_TOKEN_MP = '';
    if (strpos($rows[0]['ACCESS_TOKEN_MP'], '{') === false) {
        MercadoPago\SDK::setAccessToken($rows[0]['ACCESS_TOKEN_MP']);
    } else {
        $__url = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $ACCESS_TOKEN_MP = get_object_vars(json_decode($rows[0]['ACCESS_TOKEN_MP']))[$__url];
        MercadoPago\SDK::setAccessToken($ACCESS_TOKEN_MP);
    }

    $merchant_order = null;

    $payment = MercadoPago\Payment::find_by_id($id);
    // Get the payment and the corresponding merchant_order reported by the IPN.
    $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order_id);

    $curso_extenal_reference = explode('-', $payment->external_reference);

    $curso = $curso_extenal_reference[0];

    $extenal_reference = $curso_extenal_reference[1];

    $mp_fee = 0;
    $fecha_compra = $payment->date_created;
    $fecha_acreditacion = $payment->money_release_date;
    $mp_fee_details = $payment->fee_details;

    foreach ($mp_fee_details as $value) {
        if ($value->type == 'mercadopago_fee') {
            $mp_fee = $mp_fee_details[0]->amount;
        }
    }

    $payment_type_id = $payment->payment_type_id;
    $description = $payment->description;
    $net_received_amt = $payment->transaction_details->net_received_amount;
    $payeer = $payment->payer;
    $pagador_email = $payeer->email;
    $pagador_nombre = $payeer->first_name;
    $pagador_apellido = $payeer->last_name;
    $pagador_tipo = $payeer->type;
    $pagador_id = $payeer->id;
    $metodo_de_pago = $payment->payment_method_id;

    //Format variables	
    if ($fecha_compra != null) {
        $fecha_compra = new datetime($fecha_compra);
        $fecha_compra = $fecha_compra->format('Y-m-d H:i:s');
    }

    if ($fecha_acreditacion != null) {
        $fecha_acreditacion = new datetime($fecha_acreditacion);
        $fecha_acreditacion = $fecha_acreditacion->format('Y-m-d H:i:s');
    }


    $stmt1 = $cnx->prepare("INSERT INTO notificaciones_mp(TOPIC,ID,PAGO_ID_MP,ESTADO_MP,ESTADO_DETALLE_MP) VALUES (?,?,?,?,?)");
    $stmt1->bindValue(1, $topic, PDO::PARAM_STR);
    $stmt1->bindValue(2, $extenal_reference, PDO::PARAM_STR);
    $stmt1->bindValue(3, $id, PDO::PARAM_STR);
    $stmt1->bindValue(4, $payment->status, PDO::PARAM_STR);
    $stmt1->bindValue(5, $payment->status_detail, PDO::PARAM_STR);
    $stmt1->execute();

    $stmt1 = $cnx->prepare("UPDATE ventas SET PAGO_ID_MP=?,ESTADO_MP=?,ESTADO_DETALLE_MP=?,FECHA_COMPRA_MP=?,FECHA_ACREDITACION_MP=?,PAGO_TIPO_MP=?,PAGO_DESCR_MP=?,PAGADOR_EMAIL_MP=?,PAGADOR_NOMBRE_MP=?,PAGADOR_APELLIDO_MP=?,PAGADOR_TIPO_MP=?,PAGADOR_ID_MP=?,METODO_PAGO_MP=?,FEE_MP=?,IMP_RECIBIDO_NETO_MP=?,DOMINIO_F=?,ACCESS_TOKEN_F=?  WHERE CURSO=? AND ID=?");
    $stmt1->bindValue(1, $id, PDO::PARAM_STR);
    $stmt1->bindValue(2, $payment->status, PDO::PARAM_STR);
    $stmt1->bindValue(3, $payment->status_detail, PDO::PARAM_STR);
    $stmt1->bindValue(4, $fecha_compra, PDO::PARAM_STR);
    $stmt1->bindValue(5, $fecha_acreditacion, PDO::PARAM_STR);
    $stmt1->bindValue(6, $payment_type_id, PDO::PARAM_STR);
    $stmt1->bindValue(7, $description, PDO::PARAM_STR);
    $stmt1->bindValue(8, $pagador_email, PDO::PARAM_STR);
    $stmt1->bindValue(9, $pagador_nombre, PDO::PARAM_STR);
    $stmt1->bindValue(10, $pagador_apellido, PDO::PARAM_STR);
    $stmt1->bindValue(11, $pagador_tipo, PDO::PARAM_STR);
    $stmt1->bindValue(12, $pagador_id, PDO::PARAM_STR);
    $stmt1->bindValue(13, $metodo_de_pago, PDO::PARAM_STR);
    $stmt1->bindValue(14, $mp_fee, PDO::PARAM_STR);
    $stmt1->bindValue(15, $net_received_amt, PDO::PARAM_STR);
    $stmt1->bindValue(16, $__url, PDO::PARAM_STR);
    $stmt1->bindValue(17, $ACCESS_TOKEN_MP, PDO::PARAM_STR);
    $stmt1->bindValue(18, $curso, PDO::PARAM_STR);
    $stmt1->bindValue(19, $extenal_reference, PDO::PARAM_STR);
    $stmt1->execute();

    $consulta = "SELECT WEBHOOK_URL FROM webhooks_config WHERE CURSO=? AND ESTADO_MP=?";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $curso, PDO::PARAM_STR);
    $stmt->bindValue(2, $payment->status, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $webHookUrl = $rows[0]['WEBHOOK_URL'];
    //if (isset($rows[0]['WEBHOOK_URL']))
    //{
    $consulta = "SELECT CURSO,ID,FECHA,NOMBRE,APELLIDO,CELULAR,EMAIL,PAGO_ID_MP,ESTADO_MP,ESTADO_DETALLE_MP,FECHA_COMPRA_MP,FECHA_ACREDITACION_MP,PAGO_TIPO_MP,PAGO_DESCR_MP,PAGADOR_EMAIL_MP,PAGADOR_NOMBRE_MP,PAGADOR_APELLIDO_MP,PAGADOR_TIPO_MP,PAGADOR_ID_MP,METODO_PAGO_MP,FEE_MP,IMP_RECIBIDO_NETO_MP  FROM ventas WHERE CURSO=? AND ID=?";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $curso, PDO::PARAM_STR);
    $stmt->bindValue(2, $extenal_reference, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $data = array("ID" => $rows[0]['ID'],
        "CURSO" => $rows[0]['CURSO'],
                               
                               "FECHA"=> $rows[0]['FECHA'],
                               "NOMBRE" => $rows[0]['NOMBRE'],
                               "APELLIDO" => $rows[0]['APELLIDO'],
                               "PREFIJO_CEL" => $rows[0]['PREFIJO_CEL'],
                               "CELULAR" => $rows[0]['CELULAR'],
                               "EMAIL" => $rows[0]['EMAIL'],
                               "FECHA_NAC" => '',
                               "PAGO_ID_MP" => $rows[0]['PAGO_ID_MP'],
                               "ESTADO_MP" => $rows[0]['ESTADO_MP'],
                               "ESTADO_DETALLE_MP" => $rows[0]['ESTADO_DETALLE_MP']);
    /*
    $data = array("ID" => $rows[0]['ID'],
        "CURSO" => $rows[0]['CURSO'],
        "FECHA" => $rows[0]['FECHA'],
        "NOMBRE" => $rows[0]['NOMBRE'],
        "APELLIDO" => $rows[0]['APELLIDO'],
        "CELULAR" => $rows[0]['CELULAR'],
        "EMAIL" => $rows[0]['EMAIL'],
        "PAGO_ID" => $rows[0]['PAGO_ID_MP'],
        "ESTADO" => $rows[0]['ESTADO_MP'],
        "ESTADO_DETALLE" => $rows[0]['ESTADO_DETALLE_MP'],
        "FECHA_COMPRA_MP" => $rows[0]['FECHA_COMPRA_MP'],
        "FECHA_ACREDITACION_MP" => $rows[0]['FECHA_ACREDITACION_MP'],
        "PAGO_TIPO_MP" => $rows[0]['PAGO_TIPO_MP'],
        "PAGO_DESCR_MP" => $rows[0]['PAGO_DESCR_MP'],
        "PAGADOR_EMAIL_MP" => $rows[0]['PAGADOR_EMAIL_MP'],
        "PAGADOR_NOMBRE_MP" => $rows[0]['PAGADOR_NOMBRE_MP'],
        "PAGADOR_APELLIDO_MP" => $rows[0]['PAGADOR_APELLIDO_MP'],
        "PAGADOR_TIPO_MP" => $rows[0]['PAGADOR_TIPO_MP'],
        "PAGADOR_ID_MP" => $rows[0]['PAGADOR_ID_MP'],
        "METODO_PAGO_MP" => $rows[0]['METODO_PAGO_MP'],
        "FEE_MP" => $rows[0]['FEE_MP'],
        "IMP_RECIBIDO_NETO_MP" => $rows[0]['IMP_RECIBIDO_NETO_MP']);
        */

    $nombre = $rows[0]['NOMBRE'];
    $apellido = $rows[0]['APELLIDO'];
    $mail = $rows[0]['EMAIL'];
    $monto_acreditado = $rows[0]['IMP_RECIBIDO_NETO_MP'];

    $consultaIP = "SELECT * FROM `ip_visita` WHERE `correo` = ?";
    $stmtIP = $cnx->prepare($consultaIP);
    $stmtIP->bindValue(1, $mail, PDO::PARAM_STR);
    $stmtIP->execute();
    $rowsIP = $stmtIP->fetchAll(PDO::FETCH_ASSOC);

    $cache = null;
    $ipData = null;
    if (count($rowsIP) > 0) {
        $cache = json_decode($rowsIP[0]['cache'] . '');
        $ipData = json_decode($rowsIP[0]['data']. '');
    }

    ApiFacebookEventsFunciones::initPaymentSendDataDonePaymentFacebook($cache, $ipData, $mail, $monto_acreditado, 'ARS', 'https://' . $_SERVER['HTTP_HOST'] . '/a-libraries/IPN_mp.php' );

    $data_string = json_encode($data);
    echo $data_string;
    $ch = curl_init($webHookUrl);

    curl_setopt_array($ch, array(
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HEADER => true,
        CURLOPT_HTTPHEADER => array('Content-Type:application/json', 'Content-Length: ' . strlen($data_string))));

    $result = curl_exec($ch);
    curl_close($ch);
    
    
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.aprende-idiomas.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'noreplay@aprende-idiomas.com';                     //SMTP username
        $mail->Password   = 'a~dp6jQhqlL%';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('noreplay@aprende-idiomas.com', 'Aprende Idiomas');
        $mail->addAddress($pagador_email);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Aprende Idiomas Accesos';
        $mail->Body    ="<p>Te damos la bienvenida</p>
      <p>Para acceder a la plataforma visita <a href='https://academia.aprende-idiomas.com/'>https://academia.aprende-idiomas.com/</a>.</p>
      <p>Usuario: ' . $pagador_email . '</p>
      <p>Contraseña: idiomas</p>";
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//datos para enviar a sendinblue
echo "<input type='text' id='nombre' name='nombre' value='$nombre' hidden>"; 
echo "<input type='text' id='apellido' name='apellido' value='$apellido' hidden>"; 
echo "<input type='text' id='mail' name='mail' value='$mail' hidden> "; 
echo "<input type='text' id='monto' name='monto' value='$monto_acreditado' hidden> "; 

?>

 <script type="text/javascript">
(function() {
    window.sib = {
        equeue: [],
        client_key: "odq97yyhds94d616wrj5mx6i"
    };
   
    window.sendinblue = {};
    for (var j = ['track', 'identify', 'trackLink', 'page'], i = 0; i < j.length; i++) {
    (function(k) {
        window.sendinblue[k] = function() {
            var arg = Array.prototype.slice.call(arguments);
            (window.sib[k] || function() {
                    var t = {};
                    t[k] = arg;
                    window.sib.equeue.push(t);
                })(arg[0], arg[1], arg[2]);
            };
        })(j[i]);
    }
    var n = document.createElement("script"),
        i = document.getElementsByTagName("script")[0];
    n.type = "text/javascript", n.id = "sendinblue-js", n.async = !0, n.src = "https://sibautomation.com/sa.js?key=" + window.sib.client_key, i.parentNode.insertBefore(n, i), window.sendinblue.page();
})();

var nombre = document.getElementById('nombre');
var apellido = document.getElementById('apellido');
var email = document.getElementById('mail');
var monto = document.getElementById('monto');

if(nombre.value!='' && email.value !='')
{
sendinblue.track(
  'purchased_completed',
  {
    "nombre": nombre.value,
    "email" : email.value,
    "apellido" : apellido.value,
	"monto": monto.value
  });
}
?>