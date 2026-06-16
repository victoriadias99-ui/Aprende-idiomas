<?php

/**
 * logicprecios.php
 * ----------------
 * Conversión de precios para toda Latinoamérica (mismo módulo que aprende-excel).
 *
 * Los precios en la BD están almacenados en ARS.
 * Convierte a la moneda local del visitante usando USD como puente
 * (ARS → USD → moneda local).
 *
 * ⚠️ MANTENIMIENTO: actualizar las tasas cuando haya variaciones > 10%.
 * Última actualización: Junio 2026
 */

// ─────────────────────────────────────────────
// 1. TASA ARS → USD  (cuántos ARS equivalen a 1 USD)
// ─────────────────────────────────────────────
if (!defined('TASA_ARS_USD')) {
    define('TASA_ARS_USD', 1100);   // 1 USD = 1100 ARS  ← actualizar cuando varíe
}

// ─────────────────────────────────────────────
// 2. TASAS USD → MONEDA LOCAL (unidades de moneda local por 1 USD)
// ─────────────────────────────────────────────
$tasasDesdeUSD = [
    // ── Cono Sur ──
    'ARS' => 1100,     // Argentina       — Peso argentino
    'CLP' => 970,      // Chile           — Peso chileno
    'UYU' => 40,       // Uruguay         — Peso uruguayo
    'PYG' => 7600,     // Paraguay        — Guaraní

    // ── Países andinos ──
    'COP' => 4200,     // Colombia        — Peso colombiano
    'PEN' => 3.75,     // Perú            — Sol
    'BOB' => 6.9,      // Bolivia         — Boliviano
    'VES' => 37,       // Venezuela       — Bolívar soberano

    // ── México y Centroamérica ──
    'MXN' => 17.5,     // México          — Peso mexicano
    'GTQ' => 7.8,      // Guatemala       — Quetzal
    'HNL' => 24.8,     // Honduras        — Lempira
    'NIO' => 36.8,     // Nicaragua       — Córdoba
    'CRC' => 520,      // Costa Rica      — Colón
    'PAB' => 1,        // Panamá          — Balboa (= USD)

    // ── Caribe ──
    'DOP' => 59,       // R. Dominicana   — Peso dominicano
    'CUP' => 24,       // Cuba            — Peso cubano

    // ── Dolarizados y otros ──
    'USD' => 1,        // Ecuador, El Salvador, y dolarizados
    'BRL' => 5.15,     // Brasil          — Real
    'EUR' => 0.93,     // España/Europa   — Euro
];

// ─────────────────────────────────────────────
// 3. CONVERSIÓN
// ─────────────────────────────────────────────

/**
 * Convierte un precio en ARS a la moneda local (string formateado, sin símbolo).
 */
if (!function_exists('convertirPrecio')):
function convertirPrecio($precioARS, $moneda) {
    global $tasasDesdeUSD;

    if (!isset($precioARS) || $precioARS === '' || !is_numeric($precioARS)) {
        return '';
    }

    $precioUSD   = floatval($precioARS) / TASA_ARS_USD;
    $tasaLocal   = isset($tasasDesdeUSD[$moneda]) ? $tasasDesdeUSD[$moneda] : 1;
    $precioLocal = $precioUSD * $tasaLocal;

    return formatearPrecio($precioLocal, $moneda);
}
endif;

/**
 * Devuelve el precio convertido como número (float, sin formatear).
 * Necesario para Stripe (monto en unidades/centavos).
 */
if (!function_exists('convertirPrecioNumerico')):
function convertirPrecioNumerico($precioARS, $moneda) {
    global $tasasDesdeUSD;

    if (!isset($precioARS) || $precioARS === '' || !is_numeric($precioARS)) {
        return 0.0;
    }

    $precioUSD = floatval($precioARS) / TASA_ARS_USD;
    $tasaLocal = isset($tasasDesdeUSD[$moneda]) ? $tasasDesdeUSD[$moneda] : 1;
    return $precioUSD * $tasaLocal;
}
endif;

// ─────────────────────────────────────────────
// 4. FORMATEO SEGÚN MONEDA
// ─────────────────────────────────────────────
if (!function_exists('formatearPrecio')):
function formatearPrecio($precio, $moneda) {
    $conDecimales = ['USD', 'EUR', 'BRL', 'PAB', 'PEN', 'BOB', 'UYU'];

    if (in_array($moneda, $conDecimales)) {
        return number_format($precio, 2, '.', ',');
    }
    return number_format($precio, 0, ',', '.');
}
endif;
