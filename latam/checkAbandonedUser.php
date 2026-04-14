<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("includes/conexion.php");
include("includes/class.autonum.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');
$cnx = OpenCon();

$consulta = "SELECT `ID`, `PRODUCTO` as CURSO, `FECHA`, `NOMBRE`, NULL AS APELLIDO, NULL AS `PREFIJO_CEL`, NULL AS CELULAR, `CORREO` AS EMAIL FROM `v2_ventas` WHERE `STATUS`='CREADO' AND TIMESTAMPDIFF(MINUTE,FECHA,NOW())>10 ORDER BY `v2_ventas`.`FECHA`";
$stmt = $cnx->prepare($consulta);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$rowsInJson = json_encode($rows);
echo $rowsInJson;

$stmt1=$cnx->prepare("UPDATE v2_ventas SET `STATUS`='abandoned' WHERE `STATUS`='CREADO'");
$stmt1->execute();
?>