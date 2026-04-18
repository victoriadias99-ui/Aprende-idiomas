<?php
/**
 * Endpoint · Listado de leads abandonados para envío con Sender (u otro tool)
 *
 * Protección: requiere query param ?key=<LEADS_API_KEY>
 * La key se configura en Railway: LEADS_API_KEY=<long-random-string>
 *
 * Modos de uso:
 *   GET /a-includes/leads_abandonados_listar.php?key=XXX
 *     → JSON con todos los leads abandonados aún no convertidos
 *   GET /...?key=XXX&pendientes=1
 *     → solo los que NO tienen email de recovery enviado
 *   GET /...?key=XXX&horas=24
 *     → solo leads más viejos que N horas (para no spammear gente que recién se fue)
 *   GET /...?key=XXX&format=csv
 *     → CSV descargable para importar a Sender manualmente
 *   POST /...?key=XXX&marcar_enviado=<id>
 *     → marca el lead como recovery enviado
 */

header('X-Robots-Tag: noindex, nofollow');

$KEY_EXPECTED = getenv('LEADS_API_KEY') ?: '';
$KEY_PROVIDED = $_GET['key'] ?? $_POST['key'] ?? '';

if (!$KEY_EXPECTED || !hash_equals($KEY_EXPECTED, $KEY_PROVIDED)) {
    http_response_code(401);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => false, 'error' => 'unauthorized. Set LEADS_API_KEY env var and pass it as ?key=']);
    exit;
}

include __DIR__ . '/conexion.php';

try {
    $cnx = OpenCon();

    // POST para marcar como enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marcar_enviado'])) {
        $id = (int)$_POST['marcar_enviado'];
        $stmt = $cnx->prepare("UPDATE `leads_abandonados` SET `RECOVERY_EMAIL_ENVIADO`=1, `FECHA_RECOVERY_ENVIO`=NOW() WHERE `ID`=?");
        $stmt->execute([$id]);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => true, 'updated' => $stmt->rowCount()]);
        exit;
    }

    // GET listar
    $pendientes = isset($_GET['pendientes']) && $_GET['pendientes'] == '1';
    $horas = isset($_GET['horas']) ? max(0, (int)$_GET['horas']) : 0;
    $format = $_GET['format'] ?? 'json';

    $sql = "SELECT
                `ID`,`EMAIL`,`NOMBRE`,`APELLIDO`,`CURSO`,`PAIS`,`MONEDA`,`PRECIO`,
                `FECHA`,`FECHA_UPDATE`,
                `RECOVERY_EMAIL_ENVIADO`,`FECHA_RECOVERY_ENVIO`,
                `CONVERTIDO`,`FECHA_CONVERSION`
            FROM `leads_abandonados`
            WHERE `CONVERTIDO` = 0";

    $params = [];
    if ($pendientes) {
        $sql .= " AND `RECOVERY_EMAIL_ENVIADO` = 0";
    }
    if ($horas > 0) {
        $sql .= " AND `FECHA_UPDATE` < DATE_SUB(NOW(), INTERVAL ? HOUR)";
        $params[] = $horas;
    }
    $sql .= " ORDER BY `FECHA_UPDATE` DESC";

    $stmt = $cnx->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($format === 'csv') {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="leads_abandonados_' . date('Y-m-d_His') . '.csv"');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['id','email','nombre','apellido','curso','pais','moneda','precio','fecha','fecha_update','recovery_enviado','convertido']);
        foreach ($rows as $r) {
            fputcsv($out, [
                $r['ID'], $r['EMAIL'], $r['NOMBRE'], $r['APELLIDO'], $r['CURSO'],
                $r['PAIS'], $r['MONEDA'], $r['PRECIO'], $r['FECHA'], $r['FECHA_UPDATE'],
                $r['RECOVERY_EMAIL_ENVIADO'], $r['CONVERTIDO'],
            ]);
        }
        fclose($out);
        exit;
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'ok' => true,
        'count' => count($rows),
        'leads' => $rows,
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} catch (Throwable $e) {
    error_log('[leads_abandonados_listar] ' . $e->getMessage());
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
