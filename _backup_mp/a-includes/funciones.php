<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

include("conexion.php");
include("class.autonum.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');

$funcion = $_GET['func'];

try {
    switch ($funcion){
        case 'SEND_DATA_PAYMENT':
            $cnx = OpenCon();
            $consulta = "INSERT INTO v2_ventas( `NOMBRE`, `CORREO`, `PRODUCTO`, `MONTO`, `MONEDA`, `PAIS`, `ID_PAGO`,`TIPO_PAGO`, `STATUS`" . (isset($_GET['data']) && $_GET['data'] != '' ? ', `DATA`' : '') .") VALUES (?,?,?,?,?,?,?,?,?" . (isset($_GET['data']) && $_GET['data'] != '' ? ',?' : '') .")";
            $stmt = $cnx->prepare($consulta);
            $stmt->bindValue(1, $_GET['nombre'] . ' ' . $_GET['apellido'], PDO::PARAM_STR);
            $stmt->bindValue(2, $_GET['email'], PDO::PARAM_STR);
            $stmt->bindValue(3, $_GET['idProducto'], PDO::PARAM_STR);
            $stmt->bindValue(4, $_GET['precio'], PDO::PARAM_STR);
            $stmt->bindValue(5, $_GET['moneda'], PDO::PARAM_STR);
            $stmt->bindValue(6, $_GET['pais'], PDO::PARAM_STR);
            $stmt->bindValue(7, $_GET['paymentId'], PDO::PARAM_STR);
            $stmt->bindValue(8, $_GET['metodoPago'], PDO::PARAM_STR);
            $stmt->bindValue(9, 'CREADO', PDO::PARAM_STR);
            if(isset($_GET['data']) && $_GET['data'] != '')
                $stmt->bindValue(10, $_GET['data'], PDO::PARAM_STR);
            $stmt->execute();

            echo json_encode(['status' => 'DONE']);
            break;
    }
} 
catch (PDOException $e) {
     echo $_GET['callback'] . "(" . json_encode(['status' => 'ERROR']) . ")";
}
?>