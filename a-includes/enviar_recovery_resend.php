<?php
/**
 * Cron · Envío de emails de carrito abandonado vía Resend (transaccional)
 *
 * Por qué transaccional y no Broadcast:
 *   Los Broadcasts de Resend solo permiten variables fijas
 *   ({{{FIRST_NAME}}}, {{{EMAIL}}}, {{{RESEND_UNSUBSCRIBE_URL}}}...), así que
 *   NO se puede inyectar la URL de recuperación distinta por lead → el botón
 *   sale vacío y el link no lleva a ningún lado. Acá armamos el HTML por lead
 *   con su URL real, por eso el link siempre funciona.
 *
 * Env vars (setear en Railway):
 *   RESEND_API_KEY   = re_xxx           (requerido)
 *   RESEND_FROM      = "Aprende Idiomas <hola@aprende-idiomas.com>"  (requerido; dominio verificado en Resend)
 *   LEADS_API_KEY    = <token>          (mismo que el listador; protege el endpoint)
 *
 * Uso (cron/Make/manual):
 *   GET /a-includes/enviar_recovery_resend.php?key=<LEADS_API_KEY>
 *     → envía a los leads pendientes y devuelve JSON con el resumen.
 *   Params opcionales:
 *     &horas=2     → solo leads cuyo último update es más viejo que N horas (default 1)
 *     &limite=50   → máximo de emails por corrida (default 100)
 *     &dry=1       → no envía ni marca; devuelve a quién enviaría (para probar)
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Robots-Tag: noindex, nofollow');

// --- Auth ---
$KEY_EXPECTED = getenv('LEADS_API_KEY') ?: '';
$KEY_PROVIDED = $_GET['key'] ?? $_POST['key'] ?? '';
if (!$KEY_EXPECTED || !hash_equals($KEY_EXPECTED, (string)$KEY_PROVIDED)) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'unauthorized. Pasá ?key=<LEADS_API_KEY>']);
    exit;
}

$RESEND_API_KEY = getenv('RESEND_API_KEY') ?: '';
$RESEND_FROM    = getenv('RESEND_FROM') ?: '';
if (!$RESEND_API_KEY || !$RESEND_FROM) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Falta configurar RESEND_API_KEY y/o RESEND_FROM en el entorno.']);
    exit;
}

$HOME   = 'https://www.aprende-idiomas.com/';
$horas  = isset($_GET['horas'])  ? max(0, (int)$_GET['horas'])  : 1;
$limite = isset($_GET['limite']) ? max(1, (int)$_GET['limite']) : 100;
$dry    = isset($_GET['dry']) && $_GET['dry'] == '1';

include __DIR__ . '/conexion.php';

/**
 * Construye el HTML del email de recuperación para un lead.
 */
function recovery_html(string $nombre, string $url): string
{
    $saludo = $nombre !== '' ? 'Hola ' . htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') . ',' : '¡Hola!';
    $urlSafe = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;color:#222;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8;padding:24px 0;">
    <tr><td align="center">
      <table role="presentation" width="560" cellpadding="0" cellspacing="0" style="max-width:560px;background:#ffffff;border-radius:10px;overflow:hidden;">
        <tr><td style="padding:32px 32px 8px;">
          <p style="font-size:16px;margin:0 0 12px;">$saludo</p>
          <h1 style="font-size:22px;margin:0 0 12px;color:#1a1a1a;">Te quedó tu curso a un paso 🎯</h1>
          <p style="font-size:15px;line-height:1.55;margin:0 0 24px;color:#444;">
            Vimos que empezaste tu inscripción pero no llegaste a completar el pago.
            Tu lugar sigue reservado: retomá donde lo dejaste con un solo clic.
          </p>
        </td></tr>
        <tr><td align="center" style="padding:0 32px 8px;">
          <a href="$urlSafe" target="_blank"
             style="display:inline-block;background:#68aa21;color:#ffffff;text-decoration:none;
                    font-size:16px;font-weight:bold;padding:14px 34px;border-radius:8px;">
            👉 Retomar mi inscripción
          </a>
        </td></tr>
        <tr><td style="padding:20px 32px 32px;">
          <p style="font-size:12px;line-height:1.5;color:#888;margin:16px 0 0;">
            Si el botón no funciona, copiá y pegá este enlace en tu navegador:<br>
            <a href="$urlSafe" style="color:#68aa21;word-break:break-all;">$urlSafe</a>
          </p>
        </td></tr>
      </table>
    </td></tr>
  </table>
</body>
</html>
HTML;
}

/**
 * Envía un email vía la API de Resend. Devuelve [ok(bool), respuesta(string)].
 */
function resend_send(string $apiKey, string $from, string $to, string $subject, string $html): array
{
    $payload = json_encode([
        'from'    => $from,
        'to'      => [$to],
        'subject' => $subject,
        'html'    => $html,
    ], JSON_UNESCAPED_UNICODE);

    $ch = curl_init('https://api.resend.com/emails');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json',
        ],
        CURLOPT_TIMEOUT        => 15,
    ]);
    $resp = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err  = curl_error($ch);
    curl_close($ch);

    if ($resp === false) {
        return [false, 'curl_error: ' . $err];
    }
    return [$code >= 200 && $code < 300, (string)$resp];
}

try {
    $cnx = OpenCon();

    // Excluimos SIEMPRE a quien ya tenga una compra completada (STATUS='DONE'),
    // aunque el flag CONVERTIDO del lead haya quedado desactualizado —p. ej. compras
    // por MercadoPago que marcan la venta con un UPDATE directo—. Así nadie que ya
    // pagó recibe el email de recuperación.
    $sql = "SELECT `ID`,`EMAIL`,`NOMBRE`,`CURSO`,`URL_CHECKOUT`
            FROM `leads_abandonados`
            WHERE `CONVERTIDO` = 0
              AND `RECOVERY_EMAIL_ENVIADO` = 0
              AND `FECHA_UPDATE` < DATE_SUB(NOW(), INTERVAL ? HOUR)
              AND LOWER(`EMAIL`) NOT IN (
                  SELECT LOWER(`CORREO`) FROM `v2_ventas`
                  WHERE `STATUS` = 'DONE' AND `CORREO` IS NOT NULL
              )
            ORDER BY `FECHA_UPDATE` ASC
            LIMIT ?";
    $stmt = $cnx->prepare($sql);
    $stmt->bindValue(1, $horas, PDO::PARAM_INT);
    $stmt->bindValue(2, $limite, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $marcar = $cnx->prepare(
        "UPDATE `leads_abandonados`
         SET `RECOVERY_EMAIL_ENVIADO`=1, `FECHA_RECOVERY_ENVIO`=NOW()
         WHERE `ID`=?"
    );

    $enviados = 0;
    $fallidos = 0;
    $detalle  = [];

    foreach ($rows as $r) {
        $checkout = trim((string)($r['URL_CHECKOUT'] ?? ''));
        $url = filter_var($checkout, FILTER_VALIDATE_URL) ? $checkout : $HOME;

        if (!filter_var($r['EMAIL'], FILTER_VALIDATE_EMAIL)) {
            $fallidos++;
            $detalle[] = ['id' => $r['ID'], 'email' => $r['EMAIL'], 'estado' => 'email_invalido'];
            continue;
        }

        if ($dry) {
            $detalle[] = ['id' => $r['ID'], 'email' => $r['EMAIL'], 'url' => $url, 'estado' => 'dry_run'];
            continue;
        }

        $html = recovery_html((string)$r['NOMBRE'], $url);
        [$ok, $resp] = resend_send(
            $RESEND_API_KEY,
            $RESEND_FROM,
            $r['EMAIL'],
            'Te quedó tu curso a un paso 🎯',
            $html
        );

        if ($ok) {
            $marcar->execute([$r['ID']]);
            $enviados++;
            $detalle[] = ['id' => $r['ID'], 'email' => $r['EMAIL'], 'estado' => 'enviado'];
        } else {
            $fallidos++;
            error_log('[enviar_recovery_resend] fallo id=' . $r['ID'] . ' resp=' . $resp);
            $detalle[] = ['id' => $r['ID'], 'email' => $r['EMAIL'], 'estado' => 'error'];
        }
    }

    echo json_encode([
        'ok'         => true,
        'dry_run'    => $dry,
        'candidatos' => count($rows),
        'enviados'   => $enviados,
        'fallidos'   => $fallidos,
        'detalle'    => $detalle,
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Throwable $e) {
    error_log('[enviar_recovery_resend] ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
