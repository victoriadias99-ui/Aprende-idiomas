<?php
if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$titulo = 'Realizar compra';
$dirpage = '../';
$curso = 'italiano_ingles';

include("../a-includes/funcionsDBStripe.php");
include("../a-includes/logicparametros.php");
require("../a-includes/Funciones.php");

$producto = getDataProductoCheckout($curso, $moneda, $country_code);
$simbolo = $producto['producto']['SIMBOLO'];
$precio = Funciones::getFormatMoneda($producto['producto']['PRECIO'], $simbolo, $producto['producto']['MONEDA']);
$moneda = $producto['producto']['MONEDA'];

$valPrecio = floatval($producto['producto']['PRECIO']);
$valPrecioOferta = floatval($producto['producto']['PRECIO_DESC']);
$valPrecioDescuento = floatval($valPrecio - $valPrecioOferta);
$precioOferta = Funciones::getFormatMoneda($valPrecioOferta, $simbolo, $producto['producto']['MONEDA']);
$precioDescuento = Funciones::getFormatMoneda($valPrecioDescuento, $simbolo, $producto['producto']['MONEDA']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Checkout · Pack Italiano + Inglés | Aprende Idiomas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
    <link rel="icon" href="../fav/favicon.ico">
    <meta name="theme-color" content="#0a0a0f">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Sora:wght@600;700;800;900&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --pink: #ec1389; --pink-soft: #fdebf4;
            --cyan: #00b6ed; --cyan-soft: #e3f6fd;
            --ink: #0a0a0f; --ink-2: #1f2030; --ink-soft: #5a5d72;
            --bg: #ffffff; --bg-soft: #f8f8fb;
            --line: rgba(10,10,15,0.08); --line-strong: rgba(10,10,15,0.14);
            --primary: #ec1389;
            --primary-deep: #c40e72;
            --primary-soft: #fdebf4;
            --gradient: linear-gradient(135deg, #ec1389 0%, #00b6ed 100%);
            --success: #15803d;
            --r-sm: 12px; --r: 18px; --r-lg: 24px; --r-xl: 32px;
            --shadow-1: 0 1px 2px rgba(10,10,15,.04), 0 4px 12px rgba(10,10,15,.06);
            --shadow-2: 0 8px 24px rgba(10,10,15,.08), 0 16px 40px rgba(10,10,15,.06);
            --shadow-3: 0 16px 40px rgba(10,10,15,.12), 0 32px 64px rgba(10,10,15,.08);
            --ease: cubic-bezier(.2,.8,.2,1);
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-soft);
            color: var(--ink);
            font-size: 16px;
            line-height: 1.55;
            -webkit-font-smoothing: antialiased;
            letter-spacing: -0.01em;
        }
        h1, h2, h3, h4, h5 {
            font-family: 'Sora', 'Inter', sans-serif;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.1;
        }
        a { color: inherit; text-decoration: none; transition: all .2s var(--ease); }
        img { max-width: 100%; display: block; }

        .co-nav {
            background: rgba(255,255,255,.9);
            backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid var(--line);
            padding: 12px 24px;
            position: sticky; top: 0;
            z-index: 1000;
        }
        .co-nav-inner {
            max-width: 1240px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .co-logo img { max-height: 48px; width: auto; }
        .co-secure {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--success);
            color: #fff;
            padding: 7px 14px;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 700;
        }

        /* Hero top with course info */
        .co-top {
            background: var(--ink);
            padding: 48px 24px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .co-top::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 80% 20%, rgba(236,19,137,.20), transparent 55%),
                radial-gradient(circle at 20% 80%, rgba(0,182,237,.20), transparent 60%);
            pointer-events: none;
        }
        .co-top-inner {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 36px;
            align-items: center;
        }
        .co-top img {
            border-radius: var(--r-lg);
            box-shadow: var(--shadow-3);
            aspect-ratio: 4/3;
            object-fit: cover;
            width: 100%;
        }
        .co-top-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            padding: 6px 14px;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700;
            margin-bottom: 14px;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .co-top h1 {
            color: #fff;
            font-size: clamp(1.8rem, 3.2vw, 2.6rem);
            margin-bottom: 10px;
        }
        .co-top h1 .grad {
            background: var(--gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .co-top p { color: rgba(255,255,255,.72); font-size: 1.02rem; }

        @media (max-width: 780px) {
            .co-top-inner { grid-template-columns: 1fr; gap: 20px; text-align: center; }
            .co-top img { max-width: 300px; margin: 0 auto; }
        }

        /* Main grid — order summary + form */
        .co-main {
            max-width: 1200px;
            margin: -40px auto 0;
            padding: 0 24px 80px;
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 24px;
            position: relative;
            z-index: 2;
        }
        @media (max-width: 960px) {
            .co-main { grid-template-columns: 1fr; }
        }

        .co-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r-xl);
            padding: 32px 28px;
            box-shadow: var(--shadow-2);
        }
        .co-card h2 { font-size: 1.25rem; margin-bottom: 18px; }

        /* Order summary */
        .co-upsell {
            border: 2px dashed var(--primary);
            background: var(--primary-soft);
            border-radius: var(--r);
            padding: 14px 16px;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            transition: all .2s var(--ease);
        }
        .co-upsell:hover { background: #fff; }
        .co-upsell input[type="checkbox"] {
            width: 18px; height: 18px;
            margin-top: 2px;
            accent-color: var(--primary);
            cursor: pointer;
        }
        .co-upsell-content b { color: var(--primary-deep); font-size: .95rem; }
        .co-upsell-content p {
            font-size: .85rem;
            color: var(--ink-soft);
            line-height: 1.5;
            margin-top: 4px;
        }
        .co-order { list-style: none; }
        .co-order li {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 14px 0;
            border-bottom: 1px solid var(--line);
            gap: 12px;
        }
        .co-order li:last-child { border-bottom: none; }
        .co-order .item-name { font-size: .95rem; font-weight: 600; color: var(--ink); }
        .co-order .item-desc { font-size: .8rem; color: var(--ink-soft); margin-top: 2px; }
        .co-order .item-price { font-size: .95rem; color: var(--ink); font-weight: 600; white-space: nowrap; }
        .co-order .discount .item-name { color: var(--pink); }
        .co-order .discount .item-price { color: var(--pink); }
        .co-order .total { font-family: 'Sora', sans-serif; padding-top: 18px; border-top: 2px solid var(--ink); margin-top: 6px; }
        .co-order .total .item-name { font-size: 1.1rem; font-weight: 800; }
        .co-order .total .item-price {
            font-size: 1.5rem;
            font-weight: 900;
            background: var(--gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .co-note { font-size: .82rem; color: var(--ink-soft); margin-top: 12px; }

        .co-feat-title {
            font-family: 'Sora', sans-serif;
            font-size: .95rem;
            font-weight: 700;
            color: var(--ink);
            margin: 24px 0 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .co-feat { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .co-feat li { display: flex; align-items: flex-start; gap: 8px; font-size: .9rem; color: var(--ink-2); }
        .co-feat .check {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px; height: 18px;
            background: var(--primary);
            color: #fff;
            border-radius: 50%;
            font-size: .64rem;
            font-weight: 800;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Form (overrides a-pages/form.php styling via specific CSS) */
        .co-form-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r-xl);
            padding: 36px 32px;
            box-shadow: var(--shadow-2);
        }
        .co-form-head { text-align: center; margin-bottom: 24px; }
        .co-form-head h2 { font-size: 1.4rem; margin-bottom: 6px; }
        .co-form-head p { color: var(--ink-soft); font-size: .92rem; }
        .co-payments-row img {
            max-height: 32px;
            margin: 0 auto 20px;
            display: block;
            opacity: .85;
        }

        /* Restyle form.php inputs */
        #procederPagoForm .form-control-lg,
        #procederPagoForm input[type="text"]:not([hidden]),
        #procederPagoForm input[type="email"]:not([hidden]) {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid var(--line);
            border-radius: var(--r);
            background: var(--bg-soft);
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: var(--ink);
            transition: all .2s var(--ease);
            margin-bottom: 10px;
        }
        #procederPagoForm input:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px var(--primary-soft);
        }
        #procederPagoForm .form-group { margin-bottom: 6px; }
        #procederPagoForm .form-row { display: block; }
        #procederPagoForm .col-12,
        #procederPagoForm .col {
            padding: 0;
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
        #procederPagoForm .row { margin: 0; }
        #procederPagoForm h5 {
            font-family: 'Sora', sans-serif;
            font-size: 1.02rem;
            font-weight: 700;
            margin: 16px 0 12px;
            color: var(--ink);
            text-align: left !important;
        }
        #procederPagoForm h5 i { color: var(--primary) !important; }
        #procederPagoForm .text-left,
        #procederPagoForm .text-center p {
            font-size: .84rem;
            color: var(--ink-soft);
            line-height: 1.5;
        }
        #procederPagoForm img[src*="front_pay"] {
            max-height: 32px;
            margin: 0 auto 16px;
        }
        #procederPagoForm .alert-danger {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #b91c1c;
            padding: 10px 14px;
            border-radius: var(--r-sm);
            font-size: .88rem;
            margin-top: 10px;
        }

        /* Payment method buttons */
        .btn-payment-cuadrado {
            background: #fff !important;
            border: 2px solid var(--line) !important;
            border-radius: var(--r) !important;
            height: auto !important;
            padding: 16px !important;
            font-size: .95rem !important;
            font-weight: 600 !important;
            color: var(--ink) !important;
            width: 100% !important;
            cursor: pointer;
            transition: all .2s var(--ease) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px;
        }
        .btn-payment-cuadrado:hover { border-color: var(--primary) !important; background: var(--primary-soft) !important; }
        .btn-payment-cuadrado.selected { border-color: var(--primary) !important; background: var(--primary-soft) !important; box-shadow: 0 0 0 3px var(--primary-soft) !important; }
        .btn-payment-cuadrado img { height: 22px !important; margin: 0 !important; }

        /* Main CTA button */
        #proceder_pago {
            width: 100% !important;
            background: var(--gradient) !important;
            color: #fff !important;
            padding: 18px !important;
            border-radius: 999px !important;
            font-family: 'Sora', sans-serif !important;
            font-weight: 800 !important;
            font-size: 1.05rem !important;
            border: none !important;
            cursor: pointer !important;
            box-shadow: 0 12px 32px rgba(236,19,137,.32) !important;
            transition: all .25s var(--ease) !important;
            margin-top: 18px !important;
        }
        #proceder_pago:hover { transform: translateY(-2px); box-shadow: 0 20px 48px rgba(236,19,137,.5) !important; }

        /* Badges section */
        .co-badges {
            max-width: 1200px;
            margin: 40px auto 0;
            padding: 0 24px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .co-badge {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r);
            padding: 24px 20px;
            text-align: center;
            box-shadow: var(--shadow-1);
        }
        .co-badge .ico {
            width: 44px; height: 44px;
            background: var(--gradient);
            color: #fff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 12px;
        }
        .co-badge h4 { font-size: .92rem; margin-bottom: 4px; font-weight: 700; }
        .co-badge p { font-size: .8rem; color: var(--ink-soft); line-height: 1.5; }
        @media (max-width: 720px) {
            .co-badges { grid-template-columns: 1fr; }
        }

        /* Testimonials */
        .co-testimonials {
            max-width: 1200px;
            margin: 60px auto 0;
            padding: 0 24px;
        }
        .co-testimonials h3 { text-align: center; font-size: 1.4rem; margin-bottom: 24px; }
        .co-tests-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .co-test {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r);
            padding: 22px;
        }
        .co-test-stars { color: #fbbf24; letter-spacing: 2px; margin-bottom: 10px; font-size: .9rem; }
        .co-test-text { font-size: .92rem; color: var(--ink-2); line-height: 1.55; margin-bottom: 14px; }
        .co-test-author { display: flex; align-items: center; gap: 10px; }
        .co-test-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--gradient);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: .78rem;
        }
        .co-test-name { font-size: .86rem; font-weight: 700; }
        .co-test-loc { font-size: .76rem; color: var(--ink-soft); }
        @media (max-width: 860px) {
            .co-tests-grid { grid-template-columns: 1fr; }
        }

        /* Footer */
        .co-footer {
            margin-top: 60px;
            background: var(--ink);
            padding: 40px 24px 24px;
            color: rgba(255,255,255,.55);
            text-align: center;
            font-size: .82rem;
        }
        .co-footer img {
            max-height: 44px;
            margin: 0 auto 14px;
            background: #fff;
            padding: 8px 12px;
            border-radius: var(--r-sm);
        }

        /* Hide legacy Bootstrap-era artifacts from form.php */
        #procederPagoForm .mb-35 { margin-bottom: 12px; }
        #procederPagoForm [hidden] { display: none !important; }
        #procederPagoForm #hint { font-size: .78rem; color: var(--ink-soft); margin-top: 4px; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
        }
    
        /* Language visual (replaces broken hero image) */
        .co-hero-viz{
            position:relative;
            aspect-ratio:4/3;
            border-radius:var(--r-lg);
            overflow:hidden;
            background:linear-gradient(135deg, var(--primary) 0%, var(--primary-deep) 100%);
            box-shadow:var(--shadow-3);
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            padding:28px;
            color:#fff;
            text-align:center;
        }
        .co-hero-viz-bg{
            position:absolute;
            inset:0;
            background:
                radial-gradient(circle at 20% 80%, rgba(236,19,137,.35), transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0,182,237,.35), transparent 55%);
            pointer-events:none;
        }
        .co-hero-viz > *{position:relative;z-index:1}
        .co-hero-viz-flag{
            font-size:clamp(3rem, 7vw, 5rem);
            line-height:1;
            margin-bottom:10px;
            filter:drop-shadow(0 12px 24px rgba(0,0,0,.3));
            animation:vizBob 5s cubic-bezier(.2,.8,.2,1) infinite;
        }
        @keyframes vizBob{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
        .co-hero-viz-greeting{
            font-family:'Sora','Inter',sans-serif;
            font-size:clamp(1.6rem, 3.2vw, 2.4rem);
            font-weight:900;
            letter-spacing:-0.03em;
            background:linear-gradient(135deg, #ffffff, #ffffff95);
            -webkit-background-clip:text;
            background-clip:text;
            color:transparent;
            margin-bottom:18px;
        }
        .co-hero-viz-words{
            display:flex;
            gap:6px;
            flex-wrap:wrap;
            justify-content:center;
            margin-bottom:16px;
        }
        .co-hero-viz-words span{
            padding:5px 12px;
            background:rgba(255,255,255,.12);
            border:1px solid rgba(255,255,255,.22);
            border-radius:999px;
            font-size:.82rem;
            font-weight:700;
            font-family:'Sora','Inter',sans-serif;
            letter-spacing:.02em;
            backdrop-filter:blur(6px);
            -webkit-backdrop-filter:blur(6px);
        }
        .co-hero-viz-tag{
            display:inline-block;
            padding:7px 14px;
            background:linear-gradient(135deg, #ec1389, #00b6ed);
            color:#fff;
            border-radius:999px;
            font-size:.72rem;
            font-weight:800;
            letter-spacing:.08em;
            text-transform:uppercase;
            box-shadow:0 8px 20px rgba(236,19,137,.35);
        }
        @media (prefers-reduced-motion:reduce){
            .co-hero-viz-flag{animation:none}
        }
    
        .co-nav-back{
            display:inline-flex;
            align-items:center;
            gap:6px;
            font-size:.86rem;
            font-weight:600;
            color:var(--ink-soft);
            padding:8px 14px;
            border-radius:999px;
            transition:all .2s var(--ease);
            text-decoration:none;
        }
        .co-nav-back:hover{color:var(--ink);background:var(--bg-soft)}
    </style>
</head>
<body>

<!-- NAV -->
<nav class="co-nav">
    <div class="co-nav-inner">
        <a href="../" class="co-logo"><img src="../img/logo.jpg" alt="Aprende Idiomas"></a>
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;justify-content:flex-end">
            <a href="/italiano-ingles/" class="co-nav-back">← Volver al curso</a>
            <span class="co-secure">🔒 Checkout seguro</span>
        </div>
    </div>
</nav>

<!-- TOP course hero -->
<section class="co-top">
    <div class="co-top-inner">
        <div class="co-hero-viz">
            <div class="co-hero-viz-bg"></div>
            <div class="co-hero-viz-flag">🇮🇹🇺🇸</div>
            <div class="co-hero-viz-greeting">Ciao + Hello!</div>
            <div class="co-hero-viz-words">
                <span class="w1">2x1</span>
                <span class="w2">Combo</span>
                <span class="w3">Pack</span>
            </div>
            <div class="co-hero-viz-tag">✦ Pack Ita+Ing</div>
        </div>
        <div>
            <div class="co-top-badge">🇮🇹🇺🇸 Italiano + Inglés</div>
            <h1>Estás a un paso.<br><span class="grad">Pack Italiano + Inglés</span></h1>
            <p>2 idiomas al precio de uno · Descuento 2x1 · Acceso inmediato después del pago · Garantía 7 días</p>
        </div>
    </div>
</section>

<!-- MAIN grid -->
<main class="co-main">

    <!-- ORDER SUMMARY -->
    <aside class="co-card">
        <h2>🛒 Resumen del pedido</h2>

        <?php foreach ($producto['pack'] as $upsell) {
            $precioItem = $upsell['PRECIO']; ?>
            <label class="co-upsell" for="up_<?= $upsell['ID_ABRE'] ?>">
                <input type="checkbox" id="up_<?= $upsell['ID_ABRE'] ?>" value="<?= $upsell['ID_ABRE'] ?>" class="check-producto-paquete">
                <div class="co-upsell-content">
                    <b><?= str_replace('{#MONTO}', Funciones::getFormatMoneda($precioItem, $simbolo, $upsell['MONEDA']), $upsell['TITULO']) ?></b>
                    <p><?= str_replace('{#MONTO}', Funciones::getFormatMoneda($precioItem, $simbolo, $upsell['MONEDA']), $upsell['DESCRIPCION']) ?></p>
                </div>
            </label>
        <?php } ?>

        <ul class="co-order">
            <li>
                <div>
                    <div class="item-name">Pack Italiano + Inglés</div>
                    <div class="item-desc">Acceso de por vida</div>
                </div>
                <span class="item-price"><?= $precio ?></span>
            </li>

            <li class="discount">
                <div>
                    <div class="item-name">🔥 Descuento aplicado</div>
                    <div class="item-desc">Oferta de lanzamiento</div>
                </div>
                <span class="item-price">- <?= $precioDescuento ?></span>
            </li>

            <?php foreach ($producto['pack'] as $c => $item) {
                $precioItem = $item['PRECIO']; ?>
                <li id="item_<?= $item['ID_ABRE'] ?>">
                    <input type="number" id="<?= $item['ID_ABRE'] ?>_item_price" value="<?= $precioItem ?>" hidden>
                    <div>
                        <div class="item-name" style="color: var(--success);">+ <?= $item['NOMBRE'] ?></div>
                        <div class="item-desc">Agregado al pack</div>
                    </div>
                    <span class="item-price"><?= Funciones::getFormatMoneda($precioItem, $simbolo, $item['MONEDA']) ?></span>
                </li>
            <?php } ?>

            <li class="total">
                <div>
                    <div class="item-name">Total a pagar</div>
                    <div class="item-desc">Pago único · Sin suscripción</div>
                </div>
                <span class="item-price" id="total_price"><?= $precioOferta ?></span>
            </li>
        </ul>

        <p class="co-note">✓ Pago por única vez · Garantía 7 días · Acceso inmediato</p>

        <div class="co-feat-title">🎯 ¿Qué incluye tu compra?</div>
        <ul class="co-feat">
            <li><span class="check">✓</span> Italiano A1 completo</li>
            <li><span class="check">✓</span> Inglés Nivel 1 completo</li>
            <li><span class="check">✓</span> Descuento por comprar los 2</li>
            <li><span class="check">✓</span> Acceso de por vida</li>
            <li><span class="check">✓</span> Certificado por cada curso</li>
            <li><span class="check">✓</span> Soporte 24hs</li>
        </ul>
    </aside>

    <!-- FORM -->
    <section class="co-form-card" id="arriba">
        <div class="co-form-head">
            <h2>✨ Completá tus datos</h2>
            <p>Creás la cuenta con tu email y recibís el acceso al instante.</p>
        </div>
        <?php include('../a-pages/form.php') ?>
    </section>

</main>

<!-- BADGES -->
<section class="co-badges">
    <div class="co-badge">
        <div class="ico">🔒</div>
        <h4>Protegemos tu privacidad</h4>
        <p>Tus datos están encriptados end-to-end con Stripe.</p>
    </div>
    <div class="co-badge">
        <div class="ico">🛡️</div>
        <h4>Tus datos están seguros</h4>
        <p>No compartimos tu información con terceros. Nunca.</p>
    </div>
    <div class="co-badge">
        <div class="ico">✓</div>
        <h4>Garantía 100%</h4>
        <p>7 días de garantía sin vueltas. Te devolvemos el 100%.</p>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="co-testimonials">
    <h3>Alumnos satisfechos ⭐</h3>
    <div class="co-tests-grid">
        <div class="co-test">
            <div class="co-test-stars">★★★★★</div>
            <p class="co-test-text">"Dos idiomas al precio de uno. Increíble oportunidad."</p>
            <div class="co-test-author">
                <span class="co-test-avatar">PL</span>
                <div><div class="co-test-name">Patricia Loredo</div><div class="co-test-loc">Lima</div></div>
            </div>
        </div>
        <div class="co-test">
            <div class="co-test-stars">★★★★★</div>
            <p class="co-test-text">"Aprovecho el viaje de avión para alternar idiomas."</p>
            <div class="co-test-author">
                <span class="co-test-avatar">DM</span>
                <div><div class="co-test-name">Damián Moretti</div><div class="co-test-loc">Montevideo</div></div>
            </div>
        </div>
        <div class="co-test">
            <div class="co-test-stars">★★★★★</div>
            <p class="co-test-text">"Excelente pack. Muy recomendado."</p>
            <div class="co-test-author">
                <span class="co-test-avatar">MC</span>
                <div><div class="co-test-name">Miriam Calderón</div><div class="co-test-loc">Bogotá</div></div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="co-footer">
    <img src="../img/logo.jpg" alt="Aprende Idiomas">
    <p>© 2026 Aprende Idiomas · Hecho con cariño en Buenos Aires</p>
    </footer>

<!-- Scripts (preservar) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../libraries/js/checkout-stripe.js?t=1"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
<?php foreach ($producto['pack'] as $c => $item) {
    echo '$("#item_' . $item['ID_ABRE'] . '").attr("style", "display: none!important");';
} ?>
$(".check-producto-paquete").on("click", function () {
    var inputs = $("#pack").val().split('|');
    var idProducto = $(this).val();
    var amount = parseFloat($("#amount").val());
    var amountPack = parseFloat($("#" + idProducto + "_item_price").val());
    if ($(this).is(":checked")) {
        $("#item_" + idProducto).attr('style', '');
        amount += amountPack;
        inputs.push(idProducto);
    } else {
        $("#item_" + idProducto).attr('style', 'display: none!important');
        inputs = inputs.filter(function (elem) { return elem != idProducto; });
        amount -= amountPack;
    }
    $("#pack").val(inputs.join("|"));
    $("#amount").val(parseFloat(amount).toFixed(1));
    $("#total_price").html($('#simbolo').val() + getFloatValue(amount) + ' ' + $('#moneda').val());
    var arrayUpsell = $("#pack").val().split('|').sort();
    $("#pack").val(arrayUpsell.join('|'));
});

$('#curso').val('<?= $curso ?>');

function getFloatValue(value) {
    var monto = parseFloat(Math.round(value * 100) / 100) + '';
    var m1 = monto.split('.');
    var m2 = m1[0].split('').reverse();
    var strValA = '';
    var cont = 0;
    for (var i = 0; i < m2.length; i++) {
        cont++;
        strValA += m2[i];
        if (cont == 3 && i < m2.length - 1) { strValA += ','; cont = 0; }
    }
    return strValA.split('').reverse().join('') + (m1[1] ? '.' + m1[1] : '');
}

// Enhance payment method visual selection
$(document).on('click', '.btn-payment-cuadrado', function() {
    $('.btn-payment-cuadrado').removeClass('selected');
    $(this).addClass('selected');
});

// Show proceder button when method selected
$(document).on('click', '.btn-payment-cuadrado', function() {
    $('#proceder_pago').show();
});
</script>

<!-- Tracking -->
<script>
(function(){
  if (typeof fbq !== 'undefined') fbq('track', 'AddToCart');
})();
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-THQ2HVF');</script>

<!-- FB Pixel -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init','851421198669354');
fbq('init','177917573796998');
fbq('track','PageView');
fbq('track','InitiateCheckout');
</script>

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VE1K0ZKEG6"></script>
<script>
window.dataLayer=window.dataLayer||[];
function gtag(){dataLayer.push(arguments);}
gtag('js',new Date());
gtag('config','G-VE1K0ZKEG6');
gtag('config','UA-196494254-1');
</script>

<script src="/libraries/js/cookie-banner.js" defer></script>
<!-- CHAT_IA_WIDGET -->
<?php include(dirname(__FILE__) . "/../a-includes/chat-widget.php"); ?>
</body>
</html>
