<?php
include("a-includes/conexion.php");
include("a-includes/class.autonum.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');
$cnx = OpenCon();

$consulta = "SELECT `ID`,`CURSO`,`FECHA`,`NOMBRE`,`APELLIDO`,`PREFIJO_CEL`,`CELULAR`,`EMAIL` FROM `ventas` WHERE CURSO IN (SELECT CURSO FROM cursos_abandonados_check) AND `ESTADO_MP`='' AND TIMESTAMPDIFF(MINUTE,FECHA,NOW())>10";
$stmt = $cnx->prepare($consulta);
$stmt->execute();
$rows1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT `ID`, `PRODUCTO` as CURSO, `FECHA`, `NOMBRE`, NULL AS APELLIDO, NULL AS `PREFIJO_CEL`, NULL AS CELULAR, `CORREO` AS EMAIL FROM `v2_ventas` WHERE `STATUS`='CREADO' AND TIMESTAMPDIFF(MINUTE,FECHA,NOW())>10 ORDER BY `v2_ventas`.`FECHA`";
$stmt = $cnx->prepare($consulta);
$stmt->execute();
$rows2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt1=$cnx->prepare("UPDATE v2_ventas SET `STATUS`='abandoned' WHERE `STATUS`='CREADO'");
$stmt1->execute();

$stmt1=$cnx->prepare("UPDATE ventas SET `ESTADO_MP`='abandoned' WHERE `ESTADO_MP`='' AND `ID` IN (SELECT * FROM (SELECT `ID` FROM `ventas` WHERE CURSO IN (SELECT CURSO FROM cursos_abandonados_check) AND `ESTADO_MP`='' AND TIMESTAMPDIFF(MINUTE,FECHA,NOW())>10) AS X)");
$stmt1->execute();

$rowsInJson = json_encode(array_merge($rows1, $rows2));
echo $rowsInJson;
?>