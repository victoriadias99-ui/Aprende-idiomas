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

// Excluimos a quien ya tenga una compra completada (STATUS='DONE') con el mismo
// correo: nadie que ya pagó —incluido MercadoPago— entra al flujo de recuperación.
$consulta = "SELECT v.`ID`, v.`PRODUCTO` as CURSO, v.`FECHA`, v.`NOMBRE`, NULL AS APELLIDO, NULL AS `PREFIJO_CEL`, NULL AS CELULAR, v.`CORREO` AS EMAIL
             FROM `v2_ventas` v
             WHERE v.`STATUS`='CREADO'
               AND TIMESTAMPDIFF(MINUTE, v.`FECHA`, NOW())>10
               AND LOWER(v.`CORREO`) NOT IN (
                   SELECT LOWER(p.`CORREO`) FROM `v2_ventas` p WHERE p.`STATUS`='DONE' AND p.`CORREO` IS NOT NULL
               )
             ORDER BY v.`FECHA`";
$stmt = $cnx->prepare($consulta);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($rows);

// Marcamos 'abandoned' solo los CREADO de quienes NO compraron (los compradores
// quedan fuera del flujo de recuperación).
$stmt1 = $cnx->prepare(
    "UPDATE v2_ventas SET `STATUS`='abandoned'
     WHERE `STATUS`='CREADO'
       AND LOWER(`CORREO`) NOT IN (
           SELECT LOWER(`CORREO`) FROM (
               SELECT `CORREO` FROM v2_ventas WHERE `STATUS`='DONE' AND `CORREO` IS NOT NULL
           ) AS x
       )"
);
$stmt1->execute();
?>