<?php
/**
 * Endpoint AJAX · Captura de lead de checkout abandonado
 *
 * POST application/json:
 *   {
 *     "email": "user@example.com",  // requerido
 *     "nombre": "Juan",              // opcional
 *     "apellido": "Pérez",           // opcional
 *     "curso": "ingles_uno",         // opcional
 *     "pais": "AR",                  // opcional
 *     "moneda": "ARS",               // opcional
 *     "precio": 15000.00,            // opcional
 *     "url": "https://..."           // opcional
 *   }
 *
 * Crea la tabla al vuelo si no existe.
 * Dedupe por (EMAIL, CURSO) — hace UPSERT.
 * No envía email (eso lo hace un cron separado + Sender).
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Robots-Tag: noindex, nofollow');

// CORS básico (solo same-origin en producción)
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (preg_match('#^https?://(www\.)?(aprende-idiomas\.com|aprende-idiomas-idiomas\.up\.railway\.app|localhost(:\d+)?)$#', $origin)) {
    header("Access-Control-Allow-Origin: $origin");
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'method_not_allowed']);
    exit;
}

// Parse payload (JSON o form-encoded)
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) {
    $data = $_POST;
}

$email    = trim($data['email']    ?? '');
$nombre   = trim($data['nombre']   ?? '');
$apellido = trim($data['apellido'] ?? '');
$curso    = trim($data['curso']    ?? '');
$pais     = trim($data['pais']     ?? '');
$moneda   = trim($data['moneda']   ?? '');
$precio   = isset($data['precio']) ? (float)$data['precio'] : null;
$url      = trim($data['url']      ?? ($_SERVER['HTTP_REFERER'] ?? ''));

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'invalid_email']);
    exit;
}

// Recolectar contexto del request
$ip = $_SERVER['HTTP_CF_CONNECTING_IP']
    ?? $_SERVER['HTTP_X_FORWARDED_FOR']
    ?? $_SERVER['REMOTE_ADDR']
    ?? '';
$ip = explode(',', $ip)[0];  // primer valor si viene lista
$ip = trim($ip);
$ua = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500);

// Si CF header presente y no dieron pais, usar el de cloudflare
if (!$pais && isset($_SERVER['HTTP_CF_IPCOUNTRY'])) {
    $pais = trim($_SERVER['HTTP_CF_IPCOUNTRY']);
}

// Conexión DB
include __DIR__ . '/conexion.php';

try {
    $cnx = OpenCon();

    // Crear tabla si no existe (idempotente)
    $cnx->exec("
        CREATE TABLE IF NOT EXISTS `leads_abandonados` (
            `ID` INT AUTO_INCREMENT PRIMARY KEY,
            `EMAIL` VARCHAR(200) NOT NULL,
            `NOMBRE` VARCHAR(100) DEFAULT NULL,
            `APELLIDO` VARCHAR(100) DEFAULT NULL,
            `CURSO` VARCHAR(100) DEFAULT NULL,
            `PAIS` VARCHAR(10) DEFAULT NULL,
            `MONEDA` VARCHAR(10) DEFAULT NULL,
            `PRECIO` DECIMAL(10,2) DEFAULT NULL,
            `IP` VARCHAR(50) DEFAULT NULL,
            `USER_AGENT` VARCHAR(500) DEFAULT NULL,
            `URL_CHECKOUT` VARCHAR(200) DEFAULT NULL,
            `FECHA` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `FECHA_UPDATE` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `RECOVERY_EMAIL_ENVIADO` TINYINT(1) DEFAULT 0,
            `FECHA_RECOVERY_ENVIO` DATETIME DEFAULT NULL,
            `RECOVERY_EMAIL_ABIERTO` TINYINT(1) DEFAULT 0,
            `RECOVERY_EMAIL_CLICKEADO` TINYINT(1) DEFAULT 0,
            `CONVERTIDO` TINYINT(1) DEFAULT 0,
            `FECHA_CONVERSION` DATETIME DEFAULT NULL,
            `ID_VENTA` INT DEFAULT NULL,
            INDEX `idx_email` (`EMAIL`),
            INDEX `idx_curso` (`CURSO`),
            INDEX `idx_convertido` (`CONVERTIDO`),
            INDEX `idx_recovery` (`RECOVERY_EMAIL_ENVIADO`, `CONVERTIDO`),
            UNIQUE KEY `unq_email_curso` (`EMAIL`, `CURSO`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");

    // UPSERT: si ya existe (email,curso), actualiza datos. Si no, inserta.
    $sql = "INSERT INTO `leads_abandonados`
        (`EMAIL`,`NOMBRE`,`APELLIDO`,`CURSO`,`PAIS`,`MONEDA`,`PRECIO`,`IP`,`USER_AGENT`,`URL_CHECKOUT`)
        VALUES (?,?,?,?,?,?,?,?,?,?)
        ON DUPLICATE KEY UPDATE
            `NOMBRE`       = COALESCE(NULLIF(VALUES(`NOMBRE`),''), `NOMBRE`),
            `APELLIDO`     = COALESCE(NULLIF(VALUES(`APELLIDO`),''), `APELLIDO`),
            `PAIS`         = COALESCE(NULLIF(VALUES(`PAIS`),''), `PAIS`),
            `MONEDA`       = COALESCE(NULLIF(VALUES(`MONEDA`),''), `MONEDA`),
            `PRECIO`       = COALESCE(VALUES(`PRECIO`), `PRECIO`),
            `IP`           = COALESCE(NULLIF(VALUES(`IP`),''), `IP`),
            `USER_AGENT`   = COALESCE(NULLIF(VALUES(`USER_AGENT`),''), `USER_AGENT`),
            `URL_CHECKOUT` = COALESCE(NULLIF(VALUES(`URL_CHECKOUT`),''), `URL_CHECKOUT`),
            `FECHA_UPDATE` = CURRENT_TIMESTAMP";

    $stmt = $cnx->prepare($sql);
    $stmt->execute([
        $email,
        $nombre,
        $apellido,
        $curso,
        $pais,
        $moneda,
        $precio,
        $ip,
        $ua,
        substr($url, 0, 200),
    ]);

    $inserted = $stmt->rowCount() === 1;  // 1 = insert, 2 = update (MySQL quirk)

    echo json_encode([
        'ok' => true,
        'inserted' => $inserted,
        'email' => $email,
    ]);
} catch (Throwable $e) {
    error_log('[capturar_lead] ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'server_error']);
}
