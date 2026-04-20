<?php
if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
date_default_timezone_set('Europe/Madrid');

include("conexion.php");
include("class.autonum.php");
$cnx = OpenCon();

$result = [];

$consulta = "SELECT DISTINCT `PRODUCTO`,`PAIS`,`MONEDA`,`NOMBRE`,`CORREO` FROM `v2_ventas` WHERE `STATUS` IN ('pendiente', 'CREATED','') AND TIMESTAMPDIFF(MINUTE,FECHA,'". date('Y-m-d H:m:s') ."')>10 ORDER BY `v2_ventas`.`ID` DESC";
$stmt = $cnx->prepare($consulta);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$result = array_merge($result, $rows);

$rowsInJson = json_encode($result);
//echo "<pre>";
echo $rowsInJson;
//echo "</pre>";

$stmt1 = $cnx->prepare("UPDATE v2_ventas SET `STATUS`='abandonado' WHERE `STATUS` IN ('pendiente', 'CREATED','') AND `ID` IN (SELECT * FROM (SELECT `ID` FROM `v2_ventas` WHERE `STATUS` IN ('pendiente', 'CREATED','') AND TIMESTAMPDIFF(MINUTE,FECHA,'". date('Y-m-d H:m:s') ."')>10) AS X)");
$stmt1->execute();

?>