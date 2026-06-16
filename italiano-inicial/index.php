<?php
if(isset($_GET['test'])){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$dirpage = '../';
$titulo = 'Aprende Idiomas - Cursos Online';
$curso = 'italiano_inicial';

require("../a-includes/Keys.php");
include("../a-includes/funcionsDB.php");
include("../a-includes/logicparametros.php");
require("../a-includes/Funciones.php");

$productoC1 = getDataProducto($curso, $moneda, $country_code);
$simbolo = $productoC1['producto']['SIMBOLO'];
$monedaOficial = $productoC1['producto']['MONEDA'];
$precioCursoOficial = Funciones::getFormatMoneda($productoC1['producto']['PRECIO'], $simbolo, $productoC1['producto']['MONEDA']);
$value = $valPrecio = $productoC1['producto']['PRECIO_DESC'];
$precioCurso = Funciones::getFormatMoneda($valPrecio, $simbolo, $productoC1['producto']['MONEDA']);
$porcentaje = '50%';
$urlCheckout = 'checkout.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Italiano A1 — Curso Online desde cero | Aprende Idiomas</title>
    <meta name="description" content="Curso de italiano nivel inicial A1. Desde cero, 25 clases, 200+ ejercicios. Certificado oficial, comunidad y 30 días de acceso.">
    <!-- SEO_TAGS_V1 -->
    <link rel="canonical" href="https://www.aprende-idiomas.com/italiano-inicial/">
    <meta name="keywords" content="curso de italiano, italiano online, italiano desde cero, italiano a1, aprender italiano, curso italiano principiantes, italiano para principiantes">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Aprende Idiomas">
    <meta property="og:locale" content="es_ES">
    <meta property="og:url" content="https://www.aprende-idiomas.com/italiano-inicial/">
    <meta property="og:title" content="Curso de Italiano Online A1 desde Cero | Aprende Idiomas">
    <meta property="og:description" content="Aprendé italiano online desde cero con el curso A1 inicial. +25 clases paso a paso, +200 ejercicios, certificado oficial y soporte de profes. Ideal para principiantes.">
    <meta property="og:image" content="https://www.aprende-idiomas.com/img/logo.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Curso de Italiano Online A1 desde Cero | Aprende Idiomas">
    <meta name="twitter:description" content="Aprendé italiano online desde cero con el curso A1 inicial. +25 clases paso a paso, +200 ejercicios, certificado oficial y soporte de profes. Ideal para principiantes.">
    <meta name="twitter:image" content="https://www.aprende-idiomas.com/img/logo.jpg">
    <script type="application/ld+json">{"@context":"https://schema.org","@type":"Course","name":"Italiano A1 — Curso Online desde cero","description":"Curso de italiano nivel A1 inicial, 100% online. Aprendé italiano desde cero con más de 25 clases paso a paso, 200 ejercicios prácticos, profesores de soporte y certificado oficial.","url":"https://www.aprende-idiomas.com/italiano-inicial/","inLanguage":"es","teaches":"Italiano","educationalLevel":"Beginner (A1)","provider":{"@type":"EducationalOrganization","name":"Aprende Idiomas","url":"https://www.aprende-idiomas.com/","logo":"https://www.aprende-idiomas.com/img/logo.jpg"},"hasCourseInstance":{"@type":"CourseInstance","courseMode":"Online","courseWorkload":"PT40H"},"about":["Italiano para principiantes","Gramática italiana","Vocabulario italiano","Conversación en italiano"]}</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
    <meta name="theme-color" content="#0a0a0f">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        /* APRENDE IDIOMAS - Italiano A1 - Preview */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        :root {
            --pink: #ec1389;
            --pink-soft: #fdebf4;
            --cyan: #00b6ed;
            --cyan-soft: #e3f6fd;
            --ink: #0a0a0f;
            --ink-2: #1f2030;
            --ink-soft: #5a5d72;
            --bg: #ffffff;
            --bg-soft: #f8f8fb;
            --line: rgba(10, 10, 15, 0.08);
            --line-strong: rgba(10, 10, 15, 0.14);

            /* Colores Italia */
            --it-green: #15803d;
            --it-green-deep: #14532d;
            --it-green-soft: #dcfce7;
            --it-red: #be123c;
            --it-red-soft: #fee2e2;
            --it-cream: #fef9f0;

            --gradient-it: linear-gradient(135deg, #15803d 0%, #be123c 100%);
            --gradient-brand: linear-gradient(135deg, #ec1389 0%, #00b6ed 100%);

            --r-sm: 12px;
            --r: 18px;
            --r-lg: 24px;
            --r-xl: 32px;
            --shadow-1: 0 1px 2px rgba(10,10,15,.04), 0 4px 12px rgba(10,10,15,.06);
            --shadow-2: 0 8px 24px rgba(10,10,15,.08), 0 16px 40px rgba(10,10,15,.06);
            --shadow-3: 0 16px 40px rgba(10,10,15,.12), 0 32px 64px rgba(10,10,15,.08);
            --shadow-it: 0 12px 32px rgba(21,128,61,.32);
            --ease: cubic-bezier(.2,.8,.2,1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--ink);
            font-size: 16px;
            line-height: 1.55;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: -0.01em;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Sora', 'Inter', sans-serif;
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1.1;
            color: var(--ink);
        }

        a { color: inherit; text-decoration: none; transition: all .2s var(--ease); }
        img { max-width: 100%; display: block; }

        /* ===== NAVBAR ===== */
        .nav {
            position: sticky;
            top: 0;
            background: rgba(255,255,255,.85);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid var(--line);
            z-index: 1000;
        }
        .nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }
        .nav-logo img { max-height: 52px; width: auto; }
        .nav-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .88rem;
            font-weight: 600;
            color: var(--ink-soft);
            padding: 8px 14px;
            border-radius: 999px;
        }
        .nav-back:hover { color: var(--ink); background: var(--bg-soft); }
        .nav-cta {
            background: var(--it-green);
            color: #fff;
            padding: 11px 22px;
            border-radius: 999px;
            font-weight: 700;
            font-size: .92rem;
            box-shadow: var(--shadow-it);
        }
        .nav-cta:hover { background: var(--it-green-deep); color: #fff; transform: translateY(-1px); }
        .nav-actions { display: flex; gap: 10px; align-items: center; }

        /* ===== HERO ===== */
        .hero {
            position: relative;
            padding: 60px 0 80px;
            overflow: hidden;
            background:
                radial-gradient(ellipse 60% 50% at 90% 0%, rgba(190,18,60,.10), transparent 60%),
                radial-gradient(ellipse 60% 50% at 0% 100%, rgba(21,128,61,.10), transparent 60%),
                #fff;
        }
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(10,10,15,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(10,10,15,.04) 1px, transparent 1px);
            background-size: 56px 56px;
            mask-image: radial-gradient(ellipse at center, #000 30%, transparent 75%);
            -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 75%);
            pointer-events: none;
        }
        .hero-inner {
            position: relative;
            z-index: 1;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: grid;
            grid-template-columns: 1fr 1.05fr;
            gap: 60px;
            align-items: center;
        }
        .hero-visual { position: relative; }
        .hero-img {
            width: 100%;
            border-radius: var(--r-xl);
            box-shadow: var(--shadow-3);
            display: block;
            transform: rotate(-1deg);
            transition: transform .5s var(--ease);
        }
        .hero-img:hover { transform: rotate(0deg) scale(1.01); }

        .hero-flag {
            position: absolute;
            top: -16px;
            right: -16px;
            background: #fff;
            padding: 14px 22px;
            border-radius: 999px;
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            box-shadow: var(--shadow-2);
            z-index: 2;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 3px solid var(--it-green);
            animation: bob 4s var(--ease) infinite;
        }
        .hero-flag .flag-icon { font-size: 1.5rem; }
        .hero-rating {
            position: absolute;
            bottom: -16px;
            left: -16px;
            background: #fff;
            padding: 12px 18px;
            border-radius: var(--r);
            box-shadow: var(--shadow-2);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            z-index: 2;
            border: 1px solid var(--line);
        }
        .hero-rating-stars { color: #fbbf24; font-size: 1rem; letter-spacing: 1.5px; line-height: 1; }
        .hero-rating-text { font-size: .82rem; color: var(--ink-soft); font-weight: 600; }
        .hero-rating-text b { color: var(--ink); display: block; font-size: .92rem; }
        @keyframes bob {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--it-green-soft);
            color: var(--it-green);
            border-radius: 999px;
            padding: 7px 14px;
            font-size: .78rem;
            font-weight: 700;
            margin-bottom: 22px;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .hero h1 {
            font-size: clamp(2.4rem, 4.8vw, 4rem);
            font-weight: 800;
            line-height: 0.98;
            letter-spacing: -0.045em;
            margin-bottom: 18px;
            text-wrap: balance;
        }
        .hero h1 .grad {
            background: var(--gradient-it);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .hero-sub {
            font-size: 1.1rem;
            color: var(--ink-soft);
            line-height: 1.6;
            margin-bottom: 24px;
            max-width: 540px;
        }

        /* Features list */
        .feat-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px 16px;
            margin-bottom: 28px;
        }
        .feat-list li {
            list-style: none;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: .92rem;
            color: var(--ink-2);
            font-weight: 500;
        }
        .feat-list .check {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px; height: 22px;
            background: var(--it-green);
            color: #fff;
            border-radius: 50%;
            font-size: .72rem;
            font-weight: 800;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Price block */
        .price-block {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            background: linear-gradient(135deg, var(--it-cream), #fff);
            border: 2px solid var(--it-green);
            border-radius: var(--r);
            padding: 14px 22px;
            margin-bottom: 16px;
            box-shadow: var(--shadow-1);
        }
        .price-old {
            font-size: 1.05rem;
            color: var(--ink-soft);
            text-decoration: line-through;
            font-weight: 500;
        }
        .price-new {
            font-family: 'Sora', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--it-green-deep);
            letter-spacing: -0.02em;
        }
        .price-discount {
            background: var(--pink);
            color: #fff;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 700;
            margin-left: 4px;
        }
        .price-note {
            font-size: .85rem;
            color: var(--ink-soft);
            margin-bottom: 24px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 15px 28px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 1rem;
            transition: all .25s var(--ease);
            border: none;
            cursor: pointer;
            font-family: inherit;
            white-space: nowrap;
        }
        .btn-it {
            background: var(--it-green);
            color: #fff;
            box-shadow: var(--shadow-it);
        }
        .btn-it:hover {
            background: var(--it-green-deep);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 16px 40px rgba(21,128,61,.45);
        }
        .btn-light {
            background: #fff;
            color: var(--ink);
            border: 1px solid var(--line-strong);
            box-shadow: var(--shadow-1);
        }
        .btn-light:hover { transform: translateY(-2px); box-shadow: var(--shadow-2); border-color: var(--ink); }
        .btn-arrow::after { content: '→'; font-weight: 400; transition: transform .2s var(--ease); }
        .btn:hover.btn-arrow::after { transform: translateX(3px); }

        .hero-ctas { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
        .secure-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .78rem;
            color: var(--ink-soft);
            font-weight: 500;
            margin-top: 16px;
        }
        .secure-badge::before { content: '🔒'; }

        @media (max-width: 980px) {
            .hero-inner { grid-template-columns: 1fr; gap: 40px; }
            .hero-visual { order: -1; max-width: 480px; margin: 0 auto; }
            .feat-list { grid-template-columns: 1fr; }
        }

        /* ===== SECTION HEAD ===== */
        .section-head {
            text-align: center;
            max-width: 760px;
            margin: 0 auto 56px;
            padding: 0 24px;
        }
        .section-head .eyebrow {
            display: inline-block;
            font-size: .78rem;
            font-weight: 700;
            color: var(--it-green);
            background: var(--it-green-soft);
            letter-spacing: .12em;
            text-transform: uppercase;
            margin-bottom: 14px;
            padding: 6px 14px;
            border-radius: 999px;
        }
        .section-head h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 16px;
            line-height: 1.05;
            letter-spacing: -0.04em;
        }
        .section-head h2 .grad {
            background: var(--gradient-it);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .section-head p { font-size: 1.08rem; color: var(--ink-soft); line-height: 1.6; }

        /* ===== BANNER VERDE ===== */
        .banner-it {
            background: var(--it-green);
            color: #fff;
            padding: 80px 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .banner-it::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 30%, rgba(255,255,255,.08), transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(190,18,60,.20), transparent 50%);
            pointer-events: none;
        }
        .banner-it h2 {
            position: relative;
            color: #fff;
            font-size: clamp(1.8rem, 3.6vw, 2.8rem);
            max-width: 920px;
            margin: 0 auto;
            line-height: 1.15;
        }
        .banner-it .flag-strip {
            display: inline-flex;
            margin-bottom: 24px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 6px 16px rgba(0,0,0,.2);
        }
        .banner-it .flag-strip span { width: 30px; height: 22px; }
        .banner-it .flag-strip .green { background: #15803d; }
        .banner-it .flag-strip .white { background: #fff; }
        .banner-it .flag-strip .red { background: #be123c; }

        /* ===== INTRO PROSE ===== */
        .prose {
            padding: 80px 24px;
            background: var(--it-cream);
        }
        .prose-inner {
            max-width: 760px;
            margin: 0 auto;
            text-align: center;
        }
        .prose p {
            font-size: 1.15rem;
            line-height: 1.7;
            color: var(--ink-2);
            margin-bottom: 20px;
        }
        .prose .highlight-text {
            background: var(--ink);
            color: #fff;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
        }
        .prose .no-req {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--it-green-soft);
            color: var(--it-green);
            padding: 8px 16px;
            border-radius: 999px;
            font-weight: 700;
            font-size: .92rem;
            margin: 12px 0 28px;
        }
        .prose-stats {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            margin-top: 28px;
            color: var(--ink-soft);
            font-size: .92rem;
            font-weight: 500;
        }
        .prose-stats .stars { color: #fbbf24; letter-spacing: 1.5px; }

        /* ===== APRENDERAS ===== */
        .learn {
            padding: 100px 24px;
            background: #fff;
        }
        .learn-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        .learn-img {
            width: 100%;
            border-radius: var(--r-lg);
            box-shadow: var(--shadow-3);
            aspect-ratio: 4/3;
            object-fit: cover;
        }
        .learn-content .section-head { text-align: left; margin: 0 0 28px; padding: 0; max-width: none; }
        .learn-content h2 { font-size: clamp(1.8rem, 3vw, 2.4rem); margin-bottom: 24px; }
        .learn-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .learn-list li {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg-soft);
            border: 1px solid var(--line);
            padding: 14px 18px;
            border-radius: var(--r);
            font-size: 1rem;
            font-weight: 500;
            color: var(--ink-2);
            transition: all .25s var(--ease);
        }
        .learn-list li:hover {
            background: var(--it-green-soft);
            border-color: var(--it-green);
            transform: translateX(4px);
        }
        .learn-list .check {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px; height: 28px;
            background: var(--it-green);
            color: #fff;
            border-radius: 50%;
            font-weight: 800;
            font-size: .8rem;
            flex-shrink: 0;
        }
        @media (max-width: 880px) {
            .learn-inner { grid-template-columns: 1fr; gap: 32px; }
        }

        /* ===== 3 BENEFICIOS ===== */
        .benefits { padding: 80px 24px; background: var(--bg-soft); }
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .benefit {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
            padding: 36px 28px;
            text-align: center;
            box-shadow: var(--shadow-1);
            transition: all .35s var(--ease);
            position: relative;
            overflow: hidden;
        }
        .benefit::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: var(--it-green);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .4s var(--ease);
        }
        .benefit:hover::before { transform: scaleX(1); }
        .benefit:hover { transform: translateY(-6px); box-shadow: var(--shadow-3); border-color: var(--line-strong); }
        .benefit-img {
            width: 96px; height: 96px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            box-shadow: 0 0 0 8px var(--it-green-soft), 0 8px 20px rgba(10,10,15,.08);
            transition: transform .35s var(--ease);
        }
        .benefit:hover .benefit-img { transform: scale(1.06); }
        .benefit h3 { font-size: 1.35rem; font-weight: 700; margin-bottom: 10px; }
        .benefit p { color: var(--ink-soft); font-size: .96rem; line-height: 1.6; }
        @media (max-width: 880px) {
            .benefits-grid { grid-template-columns: 1fr; }
        }

        /* ===== TEMARIO ===== */
        .syllabus { padding: 100px 24px; }
        .syllabus-inner {
            max-width: 880px;
            margin: 0 auto;
            background: var(--ink);
            border-radius: var(--r-xl);
            padding: 56px 48px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .syllabus-inner::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 80% 20%, rgba(21,128,61,.30), transparent 50%),
                radial-gradient(circle at 20% 80%, rgba(190,18,60,.25), transparent 55%);
            pointer-events: none;
        }
        .syllabus-content { position: relative; z-index: 1; }
        .syllabus h2 {
            color: #fff;
            font-size: clamp(1.8rem, 2.8vw, 2.4rem);
            margin-bottom: 12px;
            text-align: center;
        }
        .syllabus p {
            text-align: center;
            color: rgba(255,255,255,.7);
            margin-bottom: 32px;
        }
        .syllabus-toggle {
            display: block;
            width: 100%;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            color: #fff;
            padding: 18px 24px;
            border-radius: var(--r);
            font-family: inherit;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all .25s var(--ease);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .syllabus-toggle:hover { background: rgba(255,255,255,.12); }
        .syllabus-toggle .arrow { transition: transform .3s var(--ease); }
        .syllabus details[open] .syllabus-toggle .arrow { transform: rotate(180deg); }
        .syllabus-toggle::-webkit-details-marker { display: none; }
        .syllabus details summary::-webkit-details-marker { display: none; }
        .syllabus details summary { list-style: none; cursor: pointer; }

        .syllabus-list {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: var(--r);
            padding: 24px;
        }
        .syllabus-list li {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,.85);
            font-size: .9rem;
            padding: 6px 0;
        }
        .syllabus-list .num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px; height: 26px;
            background: var(--it-green);
            color: #fff;
            border-radius: 6px;
            font-weight: 800;
            font-size: .72rem;
            flex-shrink: 0;
        }
        @media (max-width: 720px) {
            .syllabus-inner { padding: 36px 24px; }
            .syllabus-list { grid-template-columns: 1fr; }
        }

        /* ===== TESTIMONIOS ===== */
        .testimonials {
            background: var(--ink);
            padding: 100px 24px;
            position: relative;
            overflow: hidden;
        }
        .testimonials::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 80% 20%, rgba(21,128,61,.20), transparent 50%),
                radial-gradient(circle at 20% 80%, rgba(190,18,60,.20), transparent 50%);
            pointer-events: none;
        }
        .testimonials-inner { position: relative; z-index: 1; max-width: 1240px; margin: 0 auto; }
        .testimonials .section-head h2 { color: #fff; }
        .testimonials .section-head p { color: rgba(255,255,255,.6); }
        .testimonials .section-head .eyebrow { background: rgba(21,128,61,.2); color: #5fd687; }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .testimonial {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: var(--r-lg);
            padding: 28px;
            backdrop-filter: blur(12px);
            transition: all .35s var(--ease);
        }
        .testimonial:hover {
            transform: translateY(-4px);
            border-color: rgba(21,128,61,.4);
            background: rgba(255,255,255,.08);
        }
        .testimonial-stars { color: #fbbf24; font-size: .95rem; letter-spacing: 2px; margin-bottom: 14px; }
        .testimonial-text {
            color: rgba(255,255,255,.92);
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .testimonial-author { display: flex; align-items: center; gap: 12px; }
        .testimonial-avatar {
            width: 44px; height: 44px;
            border-radius: 50%;
            background: var(--it-green);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: .95rem;
            border: 2px solid rgba(255,255,255,.15);
        }
        .testimonial-info { display: flex; flex-direction: column; }
        .testimonial-name { color: #fff; font-weight: 700; font-size: .95rem; }
        @media (max-width: 980px) { .testimonials-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .testimonials-grid { grid-template-columns: 1fr; } }

        /* ===== FAQ ===== */
        .faq { padding: 100px 24px; }
        .faq-inner { max-width: 820px; margin: 0 auto; }
        .faq-item {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r);
            margin-bottom: 12px;
            overflow: hidden;
            transition: all .25s var(--ease);
        }
        .faq-item[open] {
            border-color: var(--it-green);
            box-shadow: var(--shadow-2);
        }
        .faq-item summary {
            list-style: none;
            cursor: pointer;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--ink);
        }
        .faq-item summary::-webkit-details-marker { display: none; }
        .faq-item summary::after {
            content: '+';
            font-size: 1.5rem;
            font-weight: 400;
            color: var(--it-green);
            transition: transform .3s var(--ease);
            line-height: 1;
            flex-shrink: 0;
        }
        .faq-item[open] summary::after { transform: rotate(45deg); }
        .faq-item .faq-body {
            padding: 0 24px 22px;
            color: var(--ink-soft);
            font-size: .98rem;
            line-height: 1.65;
        }

        /* ===== FINAL CTA ===== */
        .final-cta {
            padding: 100px 24px;
            background: linear-gradient(135deg, var(--it-cream), #fff);
            text-align: center;
        }
        .final-cta-inner {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r-xl);
            padding: 64px;
            box-shadow: var(--shadow-2);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            text-align: left;
            position: relative;
            overflow: hidden;
        }
        .final-cta-inner::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px; height: 400px;
            background: var(--it-green);
            opacity: 0.08;
            border-radius: 50%;
            filter: blur(60px);
        }
        .final-cta-img {
            position: relative;
            z-index: 1;
            border-radius: var(--r-lg);
            box-shadow: var(--shadow-3);
            aspect-ratio: 4/3;
            object-fit: cover;
            width: 100%;
        }
        .final-cta-content { position: relative; z-index: 1; }
        .final-cta h2 { font-size: clamp(1.8rem, 3vw, 2.6rem); margin-bottom: 16px; line-height: 1.1; }
        .final-cta p { color: var(--ink-soft); font-size: 1.05rem; line-height: 1.65; margin-bottom: 24px; }
        .final-cta ul { list-style: none; margin-bottom: 24px; }
        .final-cta ul li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            font-size: .95rem;
            color: var(--ink-2);
        }
        .final-cta ul li::before {
            content: '✓';
            color: var(--it-green);
            font-weight: 800;
            font-size: 1.1rem;
        }
        @media (max-width: 880px) {
            .final-cta-inner { grid-template-columns: 1fr; padding: 36px 28px; }
        }

        /* ===== FOOTER ===== */
        footer {
            background: var(--ink);
            color: rgba(255,255,255,.7);
            padding: 60px 24px 32px;
            position: relative;
        }
        footer::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: var(--gradient-brand);
            opacity: 0.5;
        }
        .footer-inner { max-width: 1200px; margin: 0 auto; text-align: center; }
        .footer-inner img {
            max-height: 56px;
            margin: 0 auto 20px;
            background: #fff;
            padding: 10px 14px;
            border-radius: var(--r-sm);
        }
        .footer-inner p { color: rgba(255,255,255,.55); font-size: .88rem; margin-bottom: 16px; }
        .footer-inner a { color: var(--it-green); font-weight: 600; }
        .footer-inner a:hover { color: #5fd687; }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.08);
            padding-top: 20px;
            margin-top: 32px;
            font-size: .8rem;
            color: rgba(255,255,255,.4);
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-THQ2HVF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- ============ NAVBAR ============ -->
<nav class="nav">
    <div class="nav-inner">
        <a href="../" class="nav-logo"><img src="../img/logo.jpg" alt="Aprende Idiomas"></a>
        <div class="nav-actions">
            <a href="../" class="nav-back">← Todos los cursos</a>
            <a href="checkout.php" class="nav-cta">🇮🇹 Quiero el curso</a>
        </div>
    </div>
</nav>

<!-- ============ HERO ============ -->
<section class="hero">
    <div class="hero-inner">
        <div class="hero-content">
            <div class="hero-eyebrow">🇮🇹 Italiano · Nivel A1 · Desde cero</div>
            <h1>Aprendé italiano <span class="grad">desde cero</span></h1>
            <p class="hero-sub">Curso online a distancia con +25 clases paso a paso, +200 ejercicios y 30 días de acceso. Apto para iniciar tu camino hacia la ciudadanía italiana.</p>

            <ul class="feat-list">
                <li><span class="check">✓</span> +25 clases paso a paso</li>
                <li><span class="check">✓</span> +200 ejercicios prácticos</li>
<li><span class="check">✓</span> Soporte de profes online</li>
                <li><span class="check">✓</span> Certificado oficial</li>
            </ul>

            <div class="price-block">
                <span class="price-old"><?= $precioCursoOficial ?></span>
                <span class="price-new"><?= $precioCurso ?></span>
                <span class="price-discount">−<?= $porcentaje ?></span>
            </div>
            <p class="price-note">Pago único en moneda local · Sin suscripciones · Garantía de 7 días</p>

            <div class="hero-ctas">
                <a href="checkout.php" class="btn btn-it btn-arrow">Lo quiero ahora</a>
                <a href="#temario" class="btn btn-light">Ver temario</a>
            </div>
            <div class="secure-badge">Pago 100% seguro · Stripe y más</div>
        </div>

        <div class="hero-visual">
            <span class="hero-flag"><span class="flag-icon">🇮🇹</span> Ciao!</span>
            <img src="../img/curso-italiano-inicial.svg" alt="Curso de italiano A1" class="hero-img">
            <div class="hero-rating">
                <div class="hero-rating-stars">★★★★★</div>
                <div class="hero-rating-text"><b>4.9 de 5</b>+3.500 alumnos</div>
            </div>
        </div>
    </div>
</section>

<!-- ============ BANNER VERDE ============ -->
<section class="banner-it">
    <div class="flag-strip">
        <span class="green"></span><span class="white"></span><span class="red"></span>
    </div>
    <h2>La mejor forma de aprender italiano a nivel mundial</h2>
</section>

<!-- ============ INTRO PROSE ============ -->
<section class="prose">
    <div class="prose-inner">
        <p>Hablado por más de <b>70 millones de personas</b>, el italiano te ayudará a navegar las calles de Roma en tu próximo viaje al extranjero. Es la lengua romance arquetípica y un excelente punto de partida para aprender otros idiomas derivados del latín.</p>
        <p>A través de este curso vas a aprender los <b>verbos más usados</b>, los <b>tiempos verbales básicos</b> y mucho más para mantener una conversación fluida. Explicado paso a paso por nuestro profesor <span class="highlight-text">con más de 15 años de trayectoria</span>.</p>
        <div class="no-req">✦ Sin requisitos previos</div>
        <div class="prose-stats">
            <span class="stars">★★★★★</span>
            <span><b>+3.500 estudiantes</b> ya empezaron</span>
        </div>
    </div>
</section>

<!-- ============ APRENDERAS ============ -->
<section class="learn">
    <div class="learn-inner">
        <img src="img/aprenderas-italiano.svg" alt="Aprenderás italiano" class="learn-img">
        <div class="learn-content">
            <div class="section-head">
                <div class="eyebrow">Plan de estudio</div>
                <h2>Lo que vas a <span class="grad">aprender</span></h2>
            </div>
            <ul class="learn-list">
                <li><span class="check">1</span> Tiempos verbales del presente</li>
                <li><span class="check">2</span> Verbo Essere y Avere</li>
                <li><span class="check">3</span> Pronombres más usados</li>
                <li><span class="check">4</span> Vocabulario básico para conversar</li>
                <li><span class="check">5</span> Lecturas guiadas con audio</li>
                <li><span class="check">6</span> Artículos, colores, números y más</li>
            </ul>
        </div>
    </div>
</section>

<!-- ============ 3 BENEFICIOS ============ -->
<section class="benefits">
    <div class="section-head">
        <div class="eyebrow">Incluye</div>
        <h2>Todo lo que necesitás</h2>
    </div>
    <div class="benefits-grid">
        <div class="benefit">
            <img src="img/certificado.jpg" alt="Certificado" class="benefit-img">
            <h3>Certificado oficial</h3>
            <p>Obtené tu certificación oficial para sumar a tu CV al finalizar el curso.</p>
        </div>
        <div class="benefit">
            <img src="img/soporte.jpg" alt="Comunidad" class="benefit-img">
            <h3>Comunidad online</h3>
            <p>Espacio exclusivo para que practiques italiano con otros alumnos y profes.</p>
        </div>
</div>
</section>

<!-- ============ TEMARIO ============ -->
<section class="syllabus" id="temario">
    <div class="syllabus-inner">
        <div class="syllabus-content">
            <h2>Mirá todo lo que vas a aprender</h2>
            <p>+30 clases paso a paso, organizadas para que avances sin perderte.</p>

            <details>
                <summary class="syllabus-toggle">
                    <span>Ver temario completo (29 clases)</span>
                    <span class="arrow">▼</span>
                </summary>
                <ul class="syllabus-list">
                    <li><span class="num">01</span> Pronombres Personales</li>
                    <li><span class="num">02</span> Verbo Essere</li>
                    <li><span class="num">03</span> Colores</li>
                    <li><span class="num">04</span> Números</li>
                    <li><span class="num">05</span> Días de la semana</li>
                    <li><span class="num">06</span> Meses del año</li>
                    <li><span class="num">07</span> Estaciones del año</li>
                    <li><span class="num">08</span> El clima</li>
                    <li><span class="num">09</span> Verbo Tener</li>
                    <li><span class="num">10</span> Artículo determinativo singular</li>
                    <li><span class="num">11</span> L'Alfabeto</li>
                    <li><span class="num">12</span> Saludos (4 partes)</li>
                    <li><span class="num">13</span> Artículos determinativos plurales</li>
                    <li><span class="num">14</span> Artículo determinativo femenino</li>
                    <li><span class="num">15</span> Artículo indeterminativo singular</li>
                    <li><span class="num">16</span> Artículo indeterminativo femenino</li>
                    <li><span class="num">17</span> La Familia</li>
                    <li><span class="num">18</span> Animales</li>
                    <li><span class="num">19</span> Partes de la casa</li>
                    <li><span class="num">20</span> Posesivo masculino</li>
                    <li><span class="num">21</span> Ejemplos posesivo masculino</li>
                    <li><span class="num">22</span> Ejemplos posesivo femenino</li>
                    <li><span class="num">23</span> Partes del cuerpo humano</li>
                    <li><span class="num">24</span> Presente indicativo</li>
                    <li><span class="num">25</span> Tercera conjugación IRE</li>
                    <li><span class="num">26</span> Domande - Preguntas</li>
                    <li><span class="num">27</span> Preguntas personas</li>
                    <li><span class="num">28</span> Primera lectura</li>
                    <li><span class="num">29</span> Segunda lectura</li>
                </ul>
            </details>
        </div>
    </div>
</section>

<!-- ============ TESTIMONIOS ============ -->
<section class="testimonials">
    <div class="testimonials-inner">
        <div class="section-head">
            <div class="eyebrow">Reseñas</div>
            <h2>Lo que dicen nuestros alumnos</h2>
            <p>Más de 4.9★ promedio en reseñas reales de estudiantes.</p>
        </div>
        <div class="testimonials-grid">

            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">"Nunca había estudiado italiano. Parece difícil pero no lo es."</p>
                <div class="testimonial-author">
                    <span class="testimonial-avatar">RT</span>
                    <div class="testimonial-info"><span class="testimonial-name">Ramiro Testa</span></div>
                </div>
            </div>

            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">"El profesor explica muy bien y es muy claro."</p>
                <div class="testimonial-author">
                    <span class="testimonial-avatar">MP</span>
                    <div class="testimonial-info"><span class="testimonial-name">Maxi Pintos</span></div>
                </div>
            </div>

            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">"Me gustó el curso en general y especialmente la parte de lecturas."</p>
                <div class="testimonial-author">
                    <span class="testimonial-avatar">MB</span>
                    <div class="testimonial-info"><span class="testimonial-name">Martina Brasilosky</span></div>
                </div>
            </div>

            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">"Un saludo al profe, un crack."</p>
                <div class="testimonial-author">
                    <span class="testimonial-avatar">SM</span>
                    <div class="testimonial-info"><span class="testimonial-name">Sofi Martínez</span></div>
                </div>
            </div>

            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">"Esperando el próximo nivel para anotarme ya."</p>
                <div class="testimonial-author">
                    <span class="testimonial-avatar">IM</span>
                    <div class="testimonial-info"><span class="testimonial-name">Ivan Moricuo</span></div>
                </div>
            </div>

            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">"Recomiendo para los que empiezan de cero. Muy bueno."</p>
                <div class="testimonial-author">
                    <span class="testimonial-avatar">EM</span>
                    <div class="testimonial-info"><span class="testimonial-name">Emiliano Montreal</span></div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============ FAQ ============ -->
<section class="faq">
    <div class="section-head">
        <div class="eyebrow">FAQ</div>
        <h2>Preguntas frecuentes</h2>
    </div>
    <div class="faq-inner">
        <details class="faq-item">
            <summary>¿Por cuánto tiempo lo tengo o lo puedo descargar?</summary>
            <div class="faq-body">Tenés 30 días de acceso desde la compra para completar el curso a tu ritmo.</div>
        </details>
        <details class="faq-item">
            <summary>¿Cuánto dura el curso?</summary>
            <div class="faq-body">Lo que vos decidas. +25 clases para que hagas a tu ritmo. Si decidís seguir practicando, el curso no tiene fin: tenés un espacio para conversar con alumnos y practicar ejercicios.</div>
        </details>
        <details class="faq-item">
            <summary>¿Dan material práctico?</summary>
            <div class="faq-body">Sí. Además de tareas, contamos con una comunidad en Facebook donde podés comunicarte con cualquier alumno para practicar.</div>
        </details>
        <details class="faq-item">
            <summary>¿Incluye Certificación o Diploma?</summary>
            <div class="faq-body">Una vez que termines el curso podés solicitarnos gratis el Certificado de Cursado oficial.</div>
        </details>
        <details class="faq-item">
            <summary>¿Qué requisitos tiene?</summary>
            <div class="faq-body">No hay requisitos previos. Este curso es para que comiences a estudiar italiano desde cero o reforzar conocimientos previos.</div>
        </details>
        <details class="faq-item">
            <summary>¿Dan soporte?</summary>
            <div class="faq-body">Sí, damos soporte 24/7. Podés consultarnos cualquier duda por e-mail.</div>
        </details>
    </div>
</section>

<!-- ============ FINAL CTA ============ -->
<section class="final-cta">
    <div class="final-cta-inner">
        <img src="img/italiano-producto.svg" alt="Suma italiano a tu CV" class="final-cta-img">
        <div class="final-cta-content">
            <div class="hero-eyebrow">🇮🇹 Empezá hoy</div>
            <h2>Sumá italiano a tu CV</h2>
            <p>Pago único en moneda local. Sin suscripciones ni pagos mensuales. Garantía de devolución de 7 días.</p>
            <ul>
                <li>+25 clases paso a paso</li>
<li>Certificado oficial incluido</li>
                <li>Soporte personalizado por email</li>
            </ul>
            <div class="price-block">
                <span class="price-old"><?= $precioCursoOficial ?></span>
                <span class="price-new"><?= $precioCurso ?></span>
                <span class="price-discount">−<?= $porcentaje ?></span>
            </div>
            <div class="hero-ctas" style="margin-top: 8px;">
                <a href="checkout.php" class="btn btn-it btn-arrow">Inscribirme ahora</a>
            </div>
        </div>
    </div>
</section>

<!-- ============ FOOTER ============ -->
<footer>
    <div class="footer-inner">
        <img src="../img/logo.jpg" alt="Aprende Idiomas">
        <p>Cursos online de idiomas. Aprendé a tu ritmo, desde tu casa, con certificado oficial y comunidad activa.</p>
        <p></p>
        <div class="footer-bottom">© 2026 Aprende Idiomas · Hecho con cariño en Buenos Aires</div>
    </div>
</footer>


<!-- ========== TRACKING ========== -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-THQ2HVF');</script>

<!-- Facebook Pixel -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init','851421198669354');
fbq('init','177917573796998');
fbq('track','PageView');
fbq('track','ViewContent');
fbq('trackCustom','visitas <?= $curso ?>');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=851421198669354&ev=PageView&noscript=1"></noscript>

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VE1K0ZKEG6"></script>
<script>
window.dataLayer=window.dataLayer||[];
function gtag(){dataLayer.push(arguments);}
gtag('js',new Date());
gtag('config','G-VE1K0ZKEG6');
gtag('config','UA-196494254-1');
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-196494254-1"></script>

<script src="/libraries/js/cookie-banner.js" defer></script>
<!-- CHAT_IA_WIDGET -->
<?php include(dirname(__FILE__) . "/../a-includes/chat-widget.php"); ?>
</body>
</html>
