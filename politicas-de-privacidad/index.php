<?php $titulo = 'Política de Privacidad - Aprende Idiomas'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?= $titulo ?></title>
<meta name="description" content="Política de privacidad de Aprende Idiomas. Cómo tratamos tus datos personales bajo el Reglamento General de Protección de Datos (RGPD).">
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
:root{--pink:#ec1389;--pink-soft:#fdebf4;--cyan:#00b6ed;--cyan-soft:#e3f6fd;--ink:#0a0a0f;--ink-2:#1f2030;--ink-soft:#5a5d72;--bg:#fff;--bg-soft:#f8f8fb;--line:rgba(10,10,15,.08);--gradient:linear-gradient(135deg,#ec1389 0%,#00b6ed 100%);--r-sm:12px;--r:18px;--r-lg:24px;--r-xl:32px;--shadow-1:0 1px 2px rgba(10,10,15,.04),0 4px 12px rgba(10,10,15,.06);--shadow-2:0 8px 24px rgba(10,10,15,.08),0 16px 40px rgba(10,10,15,.06);--ease:cubic-bezier(.2,.8,.2,1)}
body{font-family:'Inter',-apple-system,sans-serif;background:var(--bg-soft);color:var(--ink);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;letter-spacing:-0.005em}
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
.doc-card h2{font-size:1.45rem;margin:32px 0 12px;border-left:4px solid var(--pink);padding-left:14px}
.doc-card h2:first-child{margin-top:0}
.doc-card h3{font-size:1.1rem;margin:22px 0 8px;color:var(--ink-2)}
.doc-card p{font-size:1rem;color:var(--ink-2);margin-bottom:14px;line-height:1.7}
.doc-card ul,.doc-card ol{padding-left:20px;margin-bottom:14px}
.doc-card li{font-size:1rem;color:var(--ink-2);margin-bottom:6px;line-height:1.65}
.doc-card strong{color:var(--ink);font-weight:700}
.doc-card .note{background:var(--pink-soft);border-left:4px solid var(--pink);padding:14px 18px;border-radius:var(--r-sm);margin:18px 0;color:var(--ink-2);font-size:.95rem}
.doc-card .highlight{background:linear-gradient(135deg,var(--pink-soft),var(--cyan-soft));border:1px solid var(--line);padding:20px 24px;border-radius:var(--r);margin:20px 0}
.rights-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;margin:18px 0}
.right-item{background:var(--bg-soft);border:1px solid var(--line);padding:14px 16px;border-radius:var(--r-sm);display:flex;flex-direction:column;gap:4px}
.right-item b{color:var(--ink);font-size:.92rem}
.right-item span{color:var(--ink-soft);font-size:.84rem}
footer{background:var(--ink);color:rgba(255,255,255,.6);padding:48px 24px 24px;text-align:center;position:relative}
footer::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:var(--gradient);opacity:.5}
footer img{max-height:48px;margin:0 auto 14px;background:#fff;padding:8px 12px;border-radius:var(--r-sm)}
footer p{font-size:.88rem;margin-bottom:10px}
footer a{color:var(--pink);font-weight:600}
.footer-bottom{border-top:1px solid rgba(255,255,255,.08);padding-top:18px;margin-top:24px;font-size:.8rem;color:rgba(255,255,255,.4)}
.footer-links{display:flex;justify-content:center;gap:24px;flex-wrap:wrap;margin-bottom:18px}
.footer-links a{color:rgba(255,255,255,.6);font-weight:400;font-size:.84rem}
.footer-links a:hover{color:#fff}
@media (max-width:720px){.doc-card{padding:32px 24px}.doc-card h2{font-size:1.18rem}}
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
        <h1>Política de Privacidad</h1>
        <p>Cómo tratamos tus datos personales en Aprende Idiomas. Compromiso con tu privacidad bajo el RGPD.</p>
        <p class="date">Última actualización: Abril 2026</p>
    </div>
</section>

<main>
<article class="doc-card">

<h2>1. Datos personales que recopilamos</h2>
<p>En <strong>Aprende Idiomas</strong>, operado por <strong>NEMTOR LLC</strong>, recopilamos los siguientes datos cuando usás nuestros servicios:</p>
<ul>
    <li><strong>Datos de contacto:</strong> nombre, apellido, email, país.</li>
    <li><strong>Datos de facturación:</strong> domicilio, DNI/CUIT, teléfono (solo si requerís factura).</li>
    <li><strong>Datos técnicos:</strong> dirección IP, navegador, dispositivo, idioma del sistema.</li>
    <li><strong>Datos de uso:</strong> páginas visitadas, cursos consultados, interacciones con la plataforma.</li>
    <li><strong>Datos de pago:</strong> no almacenamos datos de tarjeta — los procesa Stripe/MercadoPago.</li>
</ul>
<p>Aplicamos los principios del Reglamento General de Protección de Datos (RGPD):</p>
<ul>
    <li><strong>Licitud y transparencia:</strong> te informamos claramente qué datos tratamos y con qué fin.</li>
    <li><strong>Minimización:</strong> solo pedimos los datos estrictamente necesarios.</li>
    <li><strong>Limitación temporal:</strong> conservamos los datos solo el tiempo imprescindible.</li>
    <li><strong>Confidencialidad:</strong> implementamos medidas técnicas para proteger tus datos.</li>
</ul>

<h2>2. Finalidad y legitimación</h2>
<p>Tratamos tus datos personales con las siguientes finalidades:</p>
<ul>
    <li>Proveer los cursos y servicios contratados.</li>
    <li>Gestionar tu cuenta y accesos a la plataforma.</li>
    <li>Procesar pagos y emitir comprobantes.</li>
    <li>Enviar comunicaciones relacionadas con tu compra (confirmaciones, soporte).</li>
    <li>Enviar newsletters con novedades y promociones (solo si diste consentimiento).</li>
    <li>Mejorar la experiencia del sitio mediante análisis estadístico agregado.</li>
</ul>
<p>La base legal del tratamiento es tu <strong>consentimiento expreso</strong> y la <strong>ejecución del contrato</strong> que nos vincula al contratar un curso.</p>

<div class="note"><strong>Menores de edad:</strong> el servicio está destinado a personas mayores de 14 años. Los menores requieren autorización de sus padres o tutores legales.</div>

<h2>3. Normativa aplicable</h2>
<p>Aprende Idiomas se adhiere a las disposiciones del <strong>Reglamento General de Protección de Datos (UE) 2016/679 (RGPD)</strong> y a las normas nacionales aplicables según la jurisdicción del usuario.</p>
<p>Los datos se almacenan en servidores seguros asociados, el tiempo estrictamente necesario para los fines declarados o hasta que solicités su eliminación.</p>

<h2>4. Medidas de seguridad</h2>
<p>Implementamos medidas técnicas y organizativas apropiadas para proteger tus datos:</p>
<ul>
    <li>Certificado <strong>SSL/HTTPS</strong> en todo el sitio.</li>
    <li>Cifrado de datos sensibles en tránsito y en reposo.</li>
    <li>Pasarelas de pago certificadas PCI-DSS (Stripe, MercadoPago).</li>
    <li>Acceso restringido a datos personales solo a personal autorizado.</li>
    <li>Auditorías periódicas de seguridad y backups programados.</li>
</ul>

<h2>5. Tus derechos</h2>
<p>Podés ejercer los siguientes derechos sobre tus datos personales en cualquier momento:</p>
<div class="rights-grid">
    <div class="right-item"><b>Acceso</b><span>Saber qué datos tuyos tratamos</span></div>
    <div class="right-item"><b>Rectificación</b><span>Corregir datos inexactos</span></div>
    <div class="right-item"><b>Supresión</b><span>Solicitar eliminación ("derecho al olvido")</span></div>
    <div class="right-item"><b>Oposición</b><span>Negarte al tratamiento para marketing</span></div>
    <div class="right-item"><b>Portabilidad</b><span>Recibir tus datos en formato estándar</span></div>
    <div class="right-item"><b>Limitación</b><span>Pedir que restrinjamos el uso</span></div>
</div>
<p>Para ejercer cualquiera de estos derechos, escribinos a <a href="mailto:aprende.idiomas.latam@gmail.com">aprende.idiomas.latam@gmail.com</a> indicando el derecho que querés ejercer. Respondemos en un máximo de 48 horas.</p>

<h2>6. Enlaces externos</h2>
<p>El sitio puede contener enlaces a otras webs (redes sociales, medios de pago, servicios asociados). NEMTOR LLC no se responsabiliza por las políticas de privacidad de esos sitios. Te recomendamos leer las políticas de cada uno individualmente.</p>

<h2>7. Responsables y encargados de tratamiento</h2>
<p><strong>Responsable:</strong> NEMTOR LLC (Delaware, Estados Unidos).</p>
<p><strong>Encargados de tratamiento (proveedores):</strong></p>
<ul>
    <li><strong>Hosting:</strong> Railway (infraestructura del sitio)</li>
    <li><strong>Email marketing:</strong> según proveedor activo, siempre con cumplimiento RGPD</li>
    <li><strong>Pagos:</strong> Stripe (tarjetas internacionales) y MercadoPago (pesos argentinos)</li>
    <li><strong>Análisis:</strong> Google Analytics, Google Tag Manager</li>
    <li><strong>Publicidad:</strong> Facebook Ads, Pinterest, Google Ads (cookies anonimizadas)</li>
</ul>

<h2>8. Rastreo y publicidad</h2>
<p>Utilizamos cookies y píxeles de seguimiento (Facebook Pixel, Google Ads) para medir la efectividad de nuestras campañas y mostrar anuncios relevantes en otras plataformas.</p>
<p><strong>No vendemos ni alquilamos tus datos a terceros.</strong> Los datos compartidos con proveedores (Stripe, Google Analytics) se usan únicamente para los fines técnicos del servicio.</p>
<p>Para más información sobre cookies, consultá nuestra <a href="../politicas-de-cookies/">Política de Cookies</a>.</p>

<h2>9. Revocación del consentimiento</h2>
<p>Podés revocar tu consentimiento para el tratamiento de datos con fines de marketing en cualquier momento:</p>
<ul>
    <li>Haciendo clic en "Darse de baja" en cualquier newsletter que recibas.</li>
    <li>Escribiéndonos a <a href="mailto:aprende.idiomas.latam@gmail.com">aprende.idiomas.latam@gmail.com</a>.</li>
    <li>Eliminando cookies desde tu navegador.</li>
</ul>
<p>La revocación se hace efectiva en un máximo de 48 horas y no afecta al tratamiento previo.</p>

<h2>10. Transferencias internacionales</h2>
<p>Algunos de nuestros proveedores (Stripe, Google) están radicados en Estados Unidos. Estas transferencias internacionales se realizan bajo cláusulas contractuales tipo aprobadas por la Comisión Europea y con garantías adecuadas según el RGPD.</p>

<h2>11. Formularios de captura de datos</h2>
<p>Recopilamos tus datos a través de:</p>
<ul>
    <li>Formulario de checkout al comprar un curso.</li>
    <li>Formulario de suscripción al newsletter.</li>
    <li>Formulario de contacto general.</li>
    <li>Comentarios en artículos y reseñas.</li>
    <li>Cookies y sistemas de análisis web.</li>
</ul>

<h2>12. Redes sociales</h2>
<p>Si interactuás con nosotros en redes sociales (Facebook, Instagram), tu información se rige también por las políticas de privacidad de esas plataformas. NEMTOR LLC no controla qué información recopilan ni cómo la tratan.</p>

<h2>13. Modificaciones</h2>
<p>NEMTOR LLC se reserva el derecho de modificar esta Política de Privacidad. Cualquier cambio se notificará con al menos <strong>10 días de antelación</strong> en el sitio o por email.</p>

<h2>14. Reclamación ante autoridad de control</h2>
<p>Si considerás que hemos tratado tus datos de forma indebida, tenés derecho a presentar una reclamación ante la autoridad de protección de datos de tu país (en España: AEPD; en Argentina: AAIP; etc.).</p>

<h2>15. Contacto</h2>
<p>Para cualquier consulta sobre privacidad, escribinos a:</p>

<div class="highlight">
    <strong>Responsable de tratamiento:</strong><br>
    NEMTOR LLC<br>
    Delaware, Estados Unidos<br>
    Email: <a href="mailto:aprende.idiomas.latam@gmail.com">aprende.idiomas.latam@gmail.com</a><br>
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
        <a href="../politicas-de-privacidad/">Privacidad</a>
        <a href="mailto:aprende.idiomas.latam@gmail.com">Contacto</a>
    </div>
    <div class="footer-bottom">© 2026 NEMTOR LLC · Todos los derechos reservados</div>
</footer>

<!-- CHAT_IA_WIDGET -->
<?php include(dirname(__FILE__) . "/../a-includes/chat-widget.php"); ?>
</body>
</html>
