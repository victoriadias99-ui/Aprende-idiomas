<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/a-libraries/vendor/autoload.php';

include("../a-includes/conexion.php");
include("../a-includes/class.autonum.php");



include("ApiFacebookEvents.php");

$cnx = OpenCon();
$consultaIP = "SELECT * FROM `ip_visita` WHERE `correo` = ? ORDER BY id_ip_visita DESC";
$stmtIP = $cnx->prepare($consultaIP);
$stmtIP->bindValue(1, 'torrespereangel91@gmail.com', PDO::PARAM_STR);
$stmtIP->execute();
$rowsIP = $stmtIP->fetchAll(PDO::FETCH_ASSOC);

$cache = null;
$ipData = null;
if (count($rowsIP) > 0) {
    $cache = json_decode($rowsIP[0]['cache']);
    $ipData = json_decode($rowsIP[0]['data']);
}


ApiFacebookEventsFunciones::initPaymentSendDataDonePaymentFacebook(
        $cache, 
        $ipData, 
        'torrespereangel91@gmail.com', 
        1223, 
        'ARS', 
        'https://aprende-excel.com/a-libraries/TestFacebook.php' 
        );
