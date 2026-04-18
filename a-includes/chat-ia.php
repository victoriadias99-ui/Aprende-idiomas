<?php
/**
 * Endpoint del chat - Respuestas automáticas locales (sin IA externa).
 * Matchea la pregunta del usuario contra reglas por keywords y devuelve respuesta fija.
 * Recibe: { messages: [{role:'user'|'assistant', content:'...'}] }
 * Devuelve: { ok: true, reply: '...' } | { ok: false, error: '...' }
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Robots-Tag: noindex');

// --- Config ---
const CHAT_MAX_USER_LEN = 800;
const CHAT_RL_WINDOW    = 300; // 5 min
const CHAT_RL_MAX       = 30;  // 30 msgs / 5 min / IP

// --- Entrada ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Metodo no permitido']);
    exit;
}

$raw = file_get_contents('php://input');
$body = json_decode($raw, true);
if (!is_array($body) || empty($body['messages']) || !is_array($body['messages'])) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Formato invalido']);
    exit;
}

// --- Rate limit por IP ---
$ip = $_SERVER['HTTP_CF_CONNECTING_IP']
    ?? $_SERVER['HTTP_X_FORWARDED_FOR']
    ?? $_SERVER['REMOTE_ADDR']
    ?? 'unknown';
$ip = explode(',', $ip)[0];
$ip = preg_replace('/[^a-zA-Z0-9:.\-]/', '', $ip);

$cacheDir = __DIR__ . '/cache';
if (!is_dir($cacheDir)) @mkdir($cacheDir, 0775, true);

$rlFile = $cacheDir . '/rl_' . md5($ip) . '.json';
$now = time();
$hits = [];
if (file_exists($rlFile)) {
    $hits = @json_decode(@file_get_contents($rlFile), true) ?: [];
}
$hits = array_values(array_filter($hits, fn($t) => ($now - $t) < CHAT_RL_WINDOW));
if (count($hits) >= CHAT_RL_MAX) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'error' => 'Demasiados mensajes, esperá unos minutos.']);
    exit;
}
$hits[] = $now;
@file_put_contents($rlFile, json_encode($hits));

// --- Tomar último mensaje del usuario ---
$lastUser = '';
for ($i = count($body['messages']) - 1; $i >= 0; $i--) {
    $m = $body['messages'][$i];
    if (isset($m['role'], $m['content']) && $m['role'] === 'user') {
        $lastUser = trim((string)$m['content']);
        break;
    }
}
if ($lastUser === '') {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Sin consulta']);
    exit;
}
$lastUser = mb_substr($lastUser, 0, CHAT_MAX_USER_LEN);

// --- Normalizar (lowercase + sin acentos) ---
function chat_normalize($s) {
    $s = mb_strtolower($s, 'UTF-8');
    $from = ['á','é','í','ó','ú','ü','ñ','à','è','ì','ò','ù'];
    $to   = ['a','e','i','o','u','u','n','a','e','i','o','u'];
    return str_replace($from, $to, $s);
}

function chat_has_any($text, $keywords) {
    foreach ($keywords as $kw) {
        if (strpos($text, $kw) !== false) return true;
    }
    return false;
}

$q = chat_normalize($lastUser);

// --- Motor de reglas (primer match gana; ordená de más específico a más general) ---
$rules = [
    // --- Pago / medios de pago ---
    [
        'kw' => ['como pago', 'como se paga', 'como es el pago', 'forma de pago', 'formas de pago', 'medio de pago', 'medios de pago', 'metodo de pago', 'metodos de pago', 'pagar', 'tarjeta', 'debito', 'credito', 'mercadopago', 'mercado pago', 'transferencia', 'efectivo', 'paypal'],
        'reply' => "El pago es con tarjeta de crédito o débito. Al entrar al curso que te interese, vas al botón de compra y completás tus datos en el checkout seguro. El acceso se activa automáticamente después del pago."
    ],
    // --- Precio ---
    [
        'kw' => ['precio', 'cuesta', 'cuanto sale', 'cuanto vale', 'cuanto es', 'valor', 'costo', 'cuota', 'cuotas', 'descuento', 'oferta', 'promo'],
        'reply' => "El precio actualizado para tu país lo ves en la página del curso, el sistema te muestra el valor en tu moneda automáticamente. Entrá a la página del curso que te interese y vas a ver el precio final arriba del botón de compra."
    ],
    // --- Acceso / cuándo empieza ---
    [
        'kw' => ['acceso', 'empezar', 'cuando empiezo', 'cuando comienza', 'cuando inicia', 'inmediato', 'despues del pago', 'despues de pagar', 'cuando puedo', 'fecha de inicio'],
        'reply' => "El acceso es inmediato: apenas se acredita el pago, recibís un email con tu usuario y contraseña para entrar al campus. Podés empezar el mismo día y avanzar a tu ritmo."
    ],
    // --- Duración / acceso de por vida ---
    [
        'kw' => ['cuanto dura', 'duracion', 'tiempo del curso', 'tiempo de curso', 'meses dura', 'semanas dura', 'de por vida', 'para siempre', 'expira', 'vence', 'caduca', 'plazo'],
        'reply' => "No tiene plazo: una vez que comprás, el acceso es de por vida. Avanzás a tu ritmo, sin fechas ni horarios fijos, y podés repasar las clases cuando quieras."
    ],
    // --- Certificado ---
    [
        'kw' => ['certificado', 'certificacion', 'diploma', 'titulo', 'constancia'],
        'reply' => "Sí, al terminar el curso podés solicitar el Certificado de Cursado oficial sin costo adicional. Sirve para sumarlo a tu CV o LinkedIn."
    ],
    // --- Comunidad / soporte ---
    [
        'kw' => ['comunidad', 'grupo', 'compañeros', 'practicar', 'soporte', 'profe', 'profesor', 'ayuda del profe', 'tutor', 'dudas'],
        'reply' => "Todos los cursos incluyen comunidad online para que practiques con otros alumnos, y soporte de profes para resolver dudas mientras avanzás."
    ],
    // --- Nivel / para quién es ---
    [
        'kw' => ['desde cero', 'soy principiante', 'nunca estudie', 'sin conocimiento', 'para quien', 'para quien es', 'nivel', 'basico', 'principiante'],
        'reply' => "Los cursos de nivel inicial (A1) están pensados desde cero: no necesitás conocimientos previos. Si ya tenés base, podés ir directo al nivel A2 o B1 según el idioma."
    ],
    // --- Modalidad / online ---
    [
        'kw' => ['online', 'virtual', 'presencial', 'en vivo', 'zoom', 'grabado', 'grabadas', 'en directo', 'desde casa', 'celular', 'movil', 'app'],
        'reply' => "Los cursos son 100% online y grabados, podés verlos cuando quieras desde la compu o el celular. No hay horarios fijos ni clases en vivo, avanzás a tu ritmo."
    ],
    // --- Lista de cursos ---
    [
        'kw' => ['que cursos', 'cuales cursos', 'que idiomas', 'cuales idiomas', 'catalogo', 'listado', 'lista de cursos', 'que tienen', 'que ofrecen', 'que hay'],
        'reply' => "Estos son los cursos disponibles:\n- Inglés Nivel Uno (A1): /ingles-nivel-uno/\n- Inglés Nivel Dos (A2): /ingles-nivel-dos/\n- Italiano Inicial (A1): /italiano-inicial/\n- Italiano A2: /italiano-a2/\n- Italiano B1: /italiano-b1/\n- Pack Italiano + Inglés: /italiano-ingles/\n- Pack Italiano Experto: /italiano-pack-experto/\n\nContame qué idioma te interesa y te paso más detalle."
    ],
    // --- Idiomas específicos ---
    [
        'kw' => ['ingles', 'english'],
        'reply' => "Tenemos dos niveles de inglés:\n- Inglés Nivel Uno (A1, desde cero): /ingles-nivel-uno/\n- Inglés Nivel Dos (A2): /ingles-nivel-dos/\n\nAmbos son 100% online, acceso de por vida y certificado al terminar."
    ],
    [
        'kw' => ['italiano'],
        'reply' => "Tenemos el camino completo de italiano:\n- Italiano Inicial (A1): /italiano-inicial/\n- Italiano A2: /italiano-a2/\n- Italiano B1: /italiano-b1/\n- Pack Italiano Experto (los 3 niveles): /italiano-pack-experto/\n- Pack Italiano + Inglés: /italiano-ingles/\n\nSi arrancás de cero, te recomiendo el Inicial o el Pack Experto."
    ],
    [
        'kw' => ['aleman', 'deutsch'],
        'reply' => "Sí, tenemos curso de alemán inicial (A1) desde cero: /aleman/"
    ],
    [
        'kw' => ['japones', 'japanese'],
        'reply' => "Sí, tenemos curso de japonés inicial desde cero: /japones/"
    ],
    [
        'kw' => ['frances', 'francais'],
        'reply' => "Por el momento no tenemos curso de francés activo. ¿Te interesa alguno de los idiomas disponibles? Tenemos inglés, italiano, alemán y japonés."
    ],
    [
        'kw' => ['portugues', 'chino', 'coreano', 'ruso', 'arabe'],
        'reply' => "Por ahora ese idioma no está disponible en nuestro catálogo. Tenemos inglés, italiano, alemán y japonés. Si querés, te paso los detalles de alguno."
    ],
    // --- Contacto ---
    [
        'kw' => ['contacto', 'contactar', 'whatsapp', 'wpp', 'telefono', 'email', 'mail', 'escribir', 'hablar con alguien', 'atencion al cliente'],
        'reply' => "Podés escribirnos a  y te respondemos por ahí. También podés contarme acá qué necesitás y te oriento."
    ],
    // --- Reembolso / devolución ---
    [
        'kw' => ['reembolso', 'devolucion', 'devolver', 'garantia', 'cancelar', 'arrepentimiento'],
        'reply' => "Si no estás conforme, escribinos a  dentro de los primeros días de la compra y lo revisamos."
    ],
    // --- Saludos ---
    [
        'kw' => ['hola', 'buenas', 'buen dia', 'buenos dias', 'buenas tardes', 'buenas noches', 'hey', 'holi', 'que tal'],
        'reply' => "¡Hola! Soy el asistente de Aprende Idiomas. Puedo ayudarte con consultas sobre los cursos, precios, pago y acceso. ¿Sobre qué querés saber?"
    ],
    // --- Agradecimientos ---
    [
        'kw' => ['gracias', 'muchas gracias', 'perfecto gracias', 'genial gracias', 'ok gracias'],
        'reply' => "¡De nada! Si te queda cualquier otra duda, acá estoy."
    ],
];

// --- Buscar match ---
$reply = null;
foreach ($rules as $rule) {
    if (chat_has_any($q, $rule['kw'])) {
        $reply = $rule['reply'];
        break;
    }
}

// --- Fallback ---
if ($reply === null) {
    $reply = "No estoy seguro de haber entendido. Puedo ayudarte con:\n- Qué cursos hay y precios\n- Formas de pago y acceso\n- Certificado y comunidad\n- Duración y modalidad\n\n¿Sobre qué te gustaría saber? También podés escribirnos a .";
}

echo json_encode(['ok' => true, 'reply' => $reply], JSON_UNESCAPED_UNICODE);
