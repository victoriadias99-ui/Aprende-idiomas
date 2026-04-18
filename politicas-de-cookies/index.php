<?php
$titulo = 'Política de Cookies - Aprende Idiomas';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?= $titulo ?></title>
<meta name="description" content="Política de cookies de Aprende Idiomas. Información sobre qué cookies usamos, cómo configurarlas y cómo gestionarlas.">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="icon" href="../fav/favicon.ico">
<meta name="theme-color" content="#0a0a0f">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
    --pink:#ec1389;--pink-soft:#fdebf4;--cyan:#00b6ed;--cyan-soft:#e3f6fd;
    --ink:#0a0a0f;--ink-2:#1f2030;--ink-soft:#5a5d72;
    --bg:#fff;--bg-soft:#f8f8fb;--line:rgba(10,10,15,.08);--line-strong:rgba(10,10,15,.14);
    --gradient:linear-gradient(135deg,#ec1389 0%,#00b6ed 100%);
    --r-sm:12px;--r:18px;--r-lg:24px;--r-xl:32px;
    --shadow-1:0 1px 2px rgba(10,10,15,.04),0 4px 12px rgba(10,10,15,.06);
    --shadow-2:0 8px 24px rgba(10,10,15,.08),0 16px 40px rgba(10,10,15,.06);
    --ease:cubic-bezier(.2,.8,.2,1);
}
body{font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;background:var(--bg-soft);color:var(--ink);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;letter-spacing:-0.005em}
h1,h2,h3,h4{font-family:'Sora','Inter',sans-serif;font-weight:800;letter-spacing:-0.03em;line-height:1.15;color:var(--ink)}
a{color:var(--pink);text-decoration:none;transition:all .2s var(--ease)}
a:hover{color:var(--cyan)}
img{max-width:100%;display:block}

.nav{background:rgba(255,255,255,.9);backdrop-filter:saturate(180%) blur(20px);border-bottom:1px solid var(--line);padding:12px 24px;position:sticky;top:0;z-index:1000}
.nav-inner{max-width:1240px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:16px}
.nav-logo img{max-height:48px;width:auto}
.nav-back{display:inline-flex;align-items:center;gap:6px;font-size:.88rem;font-weight:600;color:var(--ink-soft);padding:8px 14px;border-radius:999px}
.nav-back:hover{color:var(--ink);background:var(--bg-soft)}

.hero{background:var(--ink);color:#fff;padding:72px 24px;position:relative;overflow:hidden;text-align:center}
.hero::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 80% 20%,rgba(236,19,137,.22),transparent 55%),radial-gradient(circle at 20% 80%,rgba(0,182,237,.22),transparent 55%);pointer-events:none}
.hero-inner{position:relative;z-index:1;max-width:760px;margin:0 auto}
.hero-eyebrow{display:inline-block;background:var(--gradient);color:#fff;padding:6px 16px;border-radius:999px;font-size:.76rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:18px}
.hero h1{color:#fff;font-size:clamp(2rem,4.2vw,3.2rem);margin-bottom:14px;letter-spacing:-0.04em}
.hero p{color:rgba(255,255,255,.75);font-size:1.08rem;line-height:1.6}
.hero .date{color:rgba(255,255,255,.5);font-size:.86rem;margin-top:10px}

main{max-width:860px;margin:-30px auto 0;padding:0 24px 80px;position:relative;z-index:2}
.doc-card{background:#fff;border:1px solid var(--line);border-radius:var(--r-xl);padding:52px 48px;box-shadow:var(--shadow-2)}
.doc-card h2{font-size:1.5rem;margin:32px 0 12px;color:var(--ink);border-left:4px solid var(--pink);padding-left:14px}
.doc-card h2:first-child{margin-top:0}
.doc-card h3{font-size:1.12rem;margin:22px 0 8px;color:var(--ink-2)}
.doc-card p{font-size:1rem;color:var(--ink-2);margin-bottom:14px;line-height:1.7}
.doc-card ul,.doc-card ol{padding-left:20px;margin-bottom:14px}
.doc-card li{font-size:1rem;color:var(--ink-2);margin-bottom:6px;line-height:1.65}
.doc-card strong{color:var(--ink);font-weight:700}
.doc-card table{width:100%;border-collapse:collapse;margin:18px 0;font-size:.9rem}
.doc-card th,.doc-card td{padding:12px;text-align:left;border-bottom:1px solid var(--line)}
.doc-card th{background:var(--bg-soft);font-weight:700;color:var(--ink);font-size:.86rem;letter-spacing:.02em}
.doc-card td{color:var(--ink-2)}
.doc-card .note{background:var(--pink-soft);border-left:4px solid var(--pink);padding:14px 18px;border-radius:var(--r-sm);margin:18px 0;color:var(--ink-2);font-size:.95rem}
.doc-card .highlight{background:linear-gradient(135deg,var(--pink-soft),var(--cyan-soft));border:1px solid var(--line);padding:20px 24px;border-radius:var(--r);margin:20px 0}

.browser-links{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:10px;margin-top:12px}
.browser-link{background:var(--bg-soft);border:1px solid var(--line);padding:12px 16px;border-radius:var(--r-sm);font-size:.9rem;font-weight:600;color:var(--ink-2);transition:all .2s var(--ease);display:flex;align-items:center;gap:8px}
.browser-link:hover{background:#fff;border-color:var(--pink);color:var(--pink);transform:translateY(-2px);box-shadow:var(--shadow-1)}

footer{background:var(--ink);color:rgba(255,255,255,.6);padding:48px 24px 24px;text-align:center;position:relative}
footer::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:var(--gradient);opacity:.5}
footer img{max-height:48px;margin:0 auto 14px;background:#fff;padding:8px 12px;border-radius:var(--r-sm)}
footer p{font-size:.88rem;margin-bottom:10px}
footer a{color:var(--pink);font-weight:600}
.footer-bottom{border-top:1px solid rgba(255,255,255,.08);padding-top:18px;margin-top:24px;font-size:.8rem;color:rgba(255,255,255,.4)}
.footer-links{display:flex;justify-content:center;gap:24px;flex-wrap:wrap;margin-bottom:18px}
.footer-links a{color:rgba(255,255,255,.6);font-weight:400;font-size:.84rem}
.footer-links a:hover{color:#fff}

@media (max-width:720px){
    .doc-card{padding:32px 24px}
    .doc-card h2{font-size:1.2rem}
}
</style>
</head>
<body>

<nav class="nav">
    <div class="nav-inner">
        <a href="../" class="nav-logo"><img src="../img/logo.jpg" alt="Aprende Idiomas"></a>
        <a href="../" class="nav-back">← Volver al inicio</a>
    </div>
</nav>

<section class="hero">
    <div class="hero-inner">
        <div class="hero-eyebrow">Información legal</div>
        <h1>Política de Cookies</h1>
        <p>Información sobre qué cookies usamos en Aprende Idiomas y cómo podés gestionarlas.</p>
        <p class="date">Última actualización: Abril 2026</p>
    </div>
</section>

<main>
<article class="doc-card">

<h2>1. ¿Qué son las cookies?</h2>
<p>Las <strong>cookies</strong> son pequeños archivos de texto que los sitios web envían a tu navegador (Chrome, Firefox, Safari, Edge) y se almacenan en tu dispositivo. Permiten al sitio recordar información sobre tu visita, como preferencias, idioma o sesiones activas.</p>
<p>Las cookies pueden tener distintos tiempos de vida: algunas se eliminan al cerrar el navegador (cookies de sesión) y otras permanecen por días, meses o años (cookies persistentes).</p>

<h2>2. Cookies que utilizamos</h2>
<p>En <strong>Aprende Idiomas</strong> utilizamos cookies propias y de terceros con las siguientes finalidades:</p>
<ul>
    <li><strong>Cookies técnicas:</strong> necesarias para el funcionamiento del sitio (inicio de sesión, carrito de compras, preferencias de navegación).</li>
    <li><strong>Cookies analíticas:</strong> nos ayudan a entender cómo los usuarios interactúan con el sitio para mejorar la experiencia.</li>
    <li><strong>Cookies publicitarias:</strong> permiten mostrar anuncios personalizados en redes sociales como Facebook e Instagram.</li>
    <li><strong>Cookies de redes sociales:</strong> facilitan compartir contenido en plataformas como Facebook, Instagram y WhatsApp.</li>
    <li><strong>Cookies de procesamiento de pagos:</strong> necesarias para completar tu compra de forma segura a través de Stripe y MercadoPago.</li>
</ul>

<div class="note">
    <strong>Importante:</strong> Aprende Idiomas no utiliza cookies para recoger información de identificación personal sin tu consentimiento expreso, ni comparte tus datos con terceros fuera de los servicios mencionados.
</div>

<h2>3. Cookies de terceros</h2>
<p>A continuación detallamos las cookies de servicios de terceros que utilizamos:</p>

<table>
    <thead>
        <tr><th>Proveedor</th><th>Finalidad</th><th>Duración</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Google Analytics</strong></td><td>Análisis estadístico de visitas y comportamiento</td><td>2 años</td></tr>
        <tr><td><strong>Google Tag Manager</strong></td><td>Gestión de etiquetas de analítica y marketing</td><td>Sesión</td></tr>
        <tr><td><strong>Facebook Pixel</strong></td><td>Medición de conversiones y retargeting</td><td>3 meses</td></tr>
        <tr><td><strong>Pinterest Tag</strong></td><td>Seguimiento de conversiones de Pinterest Ads</td><td>6 meses</td></tr>
        <tr><td><strong>Stripe</strong></td><td>Procesamiento seguro de pagos con tarjeta</td><td>Sesión / permanente según uso</td></tr>
        <tr><td><strong>MercadoPago</strong></td><td>Procesamiento de pagos en moneda local</td><td>Sesión / permanente según uso</td></tr>
    </tbody>
</table>

<h2>4. Cómo gestionar las cookies</h2>
<p>Podés aceptar, rechazar o eliminar las cookies desde la configuración de tu navegador. A continuación dejamos los enlaces directos a las instrucciones oficiales de cada uno:</p>

<div class="browser-links">
    <a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener" class="browser-link">🌐 Google Chrome</a>
    <a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank" rel="noopener" class="browser-link">🦊 Mozilla Firefox</a>
    <a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" rel="noopener" class="browser-link">🧭 Safari</a>
    <a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-las-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener" class="browser-link">🟦 Microsoft Edge</a>
    <a href="https://help.opera.com/en/latest/web-preferences/" target="_blank" rel="noopener" class="browser-link">🎭 Opera</a>
</div>

<p style="margin-top:18px">También podés aceptar o rechazar cookies directamente desde nuestro <strong>banner de consentimiento</strong> que aparece al ingresar por primera vez.</p>

<h2>5. ¿Qué pasa si rechazás las cookies?</h2>
<p>Podés navegar y visualizar contenido de Aprende Idiomas sin aceptar cookies no esenciales. Sin embargo, algunas funcionalidades pueden verse afectadas:</p>
<ul>
    <li>No podremos personalizar tu experiencia.</li>
    <li>Podrías ver anuncios menos relevantes.</li>
    <li>Algunas estadísticas de uso no se recopilarán.</li>
    <li>El proceso de pago seguirá funcionando (cookies técnicas esenciales).</li>
</ul>

<h2>6. Cambios en esta política</h2>
<p>Nos reservamos el derecho de actualizar esta política de cookies para reflejar cambios legales o técnicos. Cualquier modificación se publicará en esta misma página con la fecha actualizada.</p>

<h2>7. Contacto</h2>
<p>Si tenés dudas sobre nuestra política de cookies, escribinos a <a href="mailto:aprende.idiomas.latam@gmail.com">aprende.idiomas.latam@gmail.com</a> y te respondemos a la brevedad.</p>

<div class="highlight">
    <strong>Responsable de tratamiento:</strong><br>
    NEMTOR LLC<br>
    Email: aprende.idiomas.latam@gmail.com<br>
    Sitio web: https://aprende-idiomas.com
</div>

</article>
</main>

<footer>
    <img src="../img/logo.jpg" alt="Aprende Idiomas">
    <p>Cursos online de idiomas. Aprendé a tu ritmo.</p>
    <div class="footer-links">
        <a href="../">Inicio</a>
        <a href="../suscripcion/">Suscripción</a>
        <a href="../politicas-de-cookies/">Cookies</a>
        <a href="../aviso-legal/">Aviso legal</a>
        <a href="mailto:aprende.idiomas.latam@gmail.com">Contacto</a>
    </div>
    <div class="footer-bottom">© 2026 NEMTOR LLC · Todos los derechos reservados</div>
</footer>

</body>
</html>
