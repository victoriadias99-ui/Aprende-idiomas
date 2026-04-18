<?php
/**
 * Construye el contexto de productos para el chat IA.
 * Scrapea las paginas de cada curso y extrae texto limpio.
 * Resultado cacheado 6 horas en a-includes/cache/chat-context.json
 */

function chatia_get_products_context() {
    $cacheFile = __DIR__ . '/cache/chat-context.json';
    $cacheTTL = 6 * 3600; // 6 horas

    if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTTL)) {
        $cached = @json_decode(file_get_contents($cacheFile), true);
        if (is_array($cached) && !empty($cached['context'])) {
            return $cached['context'];
        }
    }

    $root = realpath(__DIR__ . '/..');
    $products = [
        'ingles-nivel-uno'       => ['slug' => 'ingles-nivel-uno',       'titulo' => 'Ingles Nivel Uno (A1)'],
        'ingles-nivel-dos'       => ['slug' => 'ingles-nivel-dos',       'titulo' => 'Ingles Nivel Dos (A2)'],
        'italiano-inicial'       => ['slug' => 'italiano-inicial',       'titulo' => 'Italiano Inicial (A1)'],
        'italiano-a2'            => ['slug' => 'italiano-a2',            'titulo' => 'Italiano A2'],
        'italiano-b1'            => ['slug' => 'italiano-b1',            'titulo' => 'Italiano B1'],
        'italiano-ingles'        => ['slug' => 'italiano-ingles',        'titulo' => 'Pack Italiano + Ingles'],
        'italiano-pack-experto'  => ['slug' => 'italiano-pack-experto',  'titulo' => 'Pack Italiano Experto'],
    ];

    $pieces = [];
    foreach ($products as $key => $p) {
        $file = $root . '/' . $p['slug'] . '/index.php';
        if (!file_exists($file)) continue;
        $html = @file_get_contents($file);
        if (!$html) continue;
        $text = chatia_html_to_text($html);
        $text = chatia_truncate($text, 3500);
        $pieces[] = "### Curso: {$p['titulo']}\nURL: /{$p['slug']}/\n{$text}";
    }

    $context = implode("\n\n---\n\n", $pieces);

    @file_put_contents($cacheFile, json_encode([
        'generated_at' => date('c'),
        'context' => $context,
    ], JSON_UNESCAPED_UNICODE));

    return $context;
}

function chatia_html_to_text($html) {
    // Quitar PHP, scripts, styles, comentarios
    $html = preg_replace('/<\?php[\s\S]*?\?>/', ' ', $html);
    $html = preg_replace('/<script\b[^>]*>[\s\S]*?<\/script>/i', ' ', $html);
    $html = preg_replace('/<style\b[^>]*>[\s\S]*?<\/style>/i', ' ', $html);
    $html = preg_replace('/<!--[\s\S]*?-->/', ' ', $html);
    // Reemplazar tags por espacios
    $text = strip_tags($html);
    // Decodificar entidades
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    // Normalizar espacios
    $text = preg_replace('/\s+/u', ' ', $text);
    return trim($text);
}

function chatia_truncate($text, $maxChars) {
    if (mb_strlen($text) <= $maxChars) return $text;
    return mb_substr($text, 0, $maxChars) . '...';
}
