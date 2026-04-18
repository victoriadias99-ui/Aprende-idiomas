<?php
/**
 * Include este archivo ANTES de </body> en cualquier pagina donde quieras el chat flotante.
 * Calcula la ruta base automaticamente segun la profundidad del archivo incluyente.
 */
if (!defined('AI_CHAT_WIDGET_LOADED')) {
    define('AI_CHAT_WIDGET_LOADED', true);

    // Detectar si estamos en subcarpeta de producto (/ingles-nivel-uno/...) o en raiz
    $scriptDir = dirname($_SERVER['SCRIPT_NAME'] ?? '/');
    $base = ($scriptDir === '/' || $scriptDir === '\\' || $scriptDir === '.') ? '' : '';
    // Siempre servimos desde raiz absoluta
    $cssHref = '/css/chat-widget.css?v=1';
    $jsSrc   = '/js/chat-widget.js?v=1';
    ?>
    <link rel="stylesheet" href="<?php echo $cssHref; ?>">
    <script src="<?php echo $jsSrc; ?>" defer></script>
    <?php
}
