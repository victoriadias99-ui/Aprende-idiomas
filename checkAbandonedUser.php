<?php
// Endpoint interno para cron/Integromat que trae leads abandonados.
// Protegido con token. Setear env var CHECK_ABANDONED_TOKEN en Railway.

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// --- Auth por token ---
$expectedToken = getenv('CHECK_ABANDONED_TOKEN') ?: '';
$providedToken = $_GET['token'] ?? $_SERVER['HTTP_X_AUTH_TOKEN'] ?? '';

if ($expectedToken === '' || !hash_equals($expectedToken, (string)$providedToken)) {
    http_response_code(401);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

include("a-includes/conexion.php");
include("a-includes/class.autonum.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');
$cnx = OpenCon();

$consulta = "SELECT `ID`, `PRODUCTO` as CURSO, `FECHA`, `NOMBRE`, NULL AS APELLIDO, NULL AS `PREFIJO_CEL`, NULL AS CELULAR, `CORREO` AS EMAIL FROM `v2_ventas` WHERE `STATUS`='CREADO' AND TIMESTAMPDIFF(MINUTE,FECHA,NOW())>10 ORDER BY `v2_ventas`.`FECHA`";
$stmt = $cnx->prepare($consulta);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($rows);

$stmt1=$cnx->prepare("UPDATE v2_ventas SET `STATUS`='abandoned' WHERE `STATUS`='CREADO'");
$stmt1->execute();
?>