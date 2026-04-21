<?php $titulo = 'Aviso Legal y Términos de Uso - Aprende Idiomas'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?= $titulo ?></title>
<meta name="description" content="Aviso legal, términos y condiciones de uso de Aprende Idiomas. Operado por NEMTOR LLC.">
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
        <h1>Aviso Legal y Términos de Uso</h1>
        <p>Términos y condiciones que rigen el uso del sitio web y los servicios de Aprende Idiomas.</p>
        <p class="date">Última actualización: Abril 2026</p>
    </div>
</section>

<main>
<article class="doc-card">

<h2>1. Identificación y finalidad</h2>
<p><strong>1.1.</strong> El presente aviso legal regula el acceso y uso del sitio web <a href="https://aprende-idiomas.com">aprende-idiomas.com</a>, operado por <strong>NEMTOR LLC</strong>, una compañía constituida bajo las leyes del Estado de Delaware, Estados Unidos.</p>
<p><strong>1.2.</strong> Los servicios ofrecidos por NEMTOR LLC incluyen: venta de cursos online de idiomas (inglés, italiano, alemán, japonés), gestión de suscripciones, administración de comunidades de alumnos y contenido formativo relacionado.</p>

<h2>2. Términos de uso</h2>
<p><strong>2.1. Aceptación.</strong> El acceso al sitio implica la aceptación automática y sin reservas de estos términos. Si no estás de acuerdo, por favor no utilices el sitio.</p>
<p><strong>2.2. Uso permitido.</strong> Te comprometés a utilizar el sitio conforme a la ley, la moral y el orden público. Queda prohibido:</p>
<ul>
    <li>Realizar actividades ilícitas o contrarias a la buena fe.</li>
    <li>Publicar contenido discriminatorio, ofensivo o ilegal.</li>
    <li>Difundir virus, malware o cualquier elemento dañino.</li>
    <li>Manipular o alterar el funcionamiento técnico del sitio.</li>
    <li>Copiar, revender o redistribuir los cursos sin autorización.</li>
</ul>
<p>NEMTOR LLC se reserva el derecho de eliminar comentarios, cerrar cuentas o denegar el acceso a usuarios que incumplan estas condiciones.</p>

<h2>3. Recopilación de información</h2>
<p>Durante el uso del sitio y la contratación de servicios podemos recopilar datos como nombre, email, país, dirección IP, navegador y hora de acceso. Para más detalles sobre el tratamiento de datos personales, consultá nuestra <a href="../politicas-de-privacidad/">Política de Privacidad</a>.</p>

<h2>4. Propiedad intelectual</h2>
<p><strong>4.1.</strong> Todos los contenidos del sitio (textos, imágenes, videos, código, diseño, logos, material educativo) son propiedad exclusiva de <strong>NEMTOR LLC</strong> o cuentan con la autorización correspondiente.</p>
<p><strong>4.2.</strong> Queda prohibida la reproducción, distribución, transformación o comunicación pública, total o parcial, sin el consentimiento expreso y por escrito de NEMTOR LLC.</p>
<p><strong>4.3.</strong> Al adquirir un curso obtenés una licencia personal, no transferible, para visualizar el contenido. La compartición de credenciales, descarga no autorizada o redistribución del material constituyen una violación de estos términos y podrán ser perseguidas legalmente.</p>

<h2>5. Limitación de responsabilidad</h2>
<p>NEMTOR LLC realiza sus mejores esfuerzos para mantener el sitio disponible y actualizado. Sin embargo, no se responsabiliza por:</p>
<ul>
    <li>Errores tipográficos o desactualizaciones puntuales en el contenido.</li>
    <li>Indisponibilidad temporal por mantenimiento o causas externas.</li>
    <li>Daños derivados de virus pese a las medidas de seguridad implementadas.</li>
    <li>Fallas en servicios de terceros (Stripe, MercadoPago, email, hosting).</li>
</ul>

<h2>6. Enlaces externos</h2>
<p>El sitio puede contener enlaces a sitios web de terceros. NEMTOR LLC no asume responsabilidad sobre el contenido, políticas ni prácticas de dichos sitios. Te recomendamos leer sus términos y políticas de privacidad individualmente.</p>
<p>Queda prohibido crear enlaces profundos o reproducir contenidos del sitio en otros portales sin autorización previa.</p>

<h2>7. Condiciones de venta</h2>
<p><strong>7.1. Precios y moneda.</strong> Los precios se muestran en la moneda local del usuario (detectada por país) o en USD según corresponda. NEMTOR LLC se reserva el derecho de modificar los precios sin previo aviso; las compras ya efectuadas no se verán afectadas.</p>
<p><strong>7.2. Métodos de pago.</strong> Los pagos se procesan a través de <strong>Stripe</strong> (tarjetas internacionales) y <strong>MercadoPago</strong> (pagos en pesos argentinos). NEMTOR LLC no almacena datos de tarjetas de crédito.</p>
<p><strong>7.3. Acceso "de por vida".</strong> El acceso "de por vida" se refiere a la vida útil del servicio mientras NEMTOR LLC mantenga operativa la plataforma. Ante cambios operacionales o cese de actividades, se notificará a los usuarios con antelación razonable.</p>

<h2>8. Suscripciones</h2>
<p><strong>8.1.</strong> Las suscripciones (mensual o anual) se cobran al inicio de cada período y se renuevan automáticamente hasta que el usuario las cancele.</p>
<p><strong>8.2.</strong> Podés cancelar tu suscripción en cualquier momento desde tu cuenta de Stripe, sin penalidad. La cancelación se hace efectiva al final del período pagado.</p>
<p><strong>8.3.</strong> No se realizan devoluciones por períodos ya facturados. Para evitar el próximo cobro, cancelá antes de la fecha de renovación.</p>

<h2>9. Garantía y reembolsos</h2>
<div class="note"><strong>Garantía de 7 días:</strong> Dispones de 7 días desde la compra para solicitar el reembolso del 100% del valor abonado, siempre que el curso no haya sido completado, descargado, ni se haya solicitado certificado durante ese lapso.</div>
<p>Pasados los 7 días no aplican reembolsos. Las solicitudes deben enviarse a  indicando motivo y nombre del curso.</p>

<h2>10. Disolución del contrato</h2>
<p>Cualquiera de las partes puede terminar la relación comercial en cualquier momento. NEMTOR LLC podrá cancelar tu cuenta en caso de:</p>
<ul>
    <li>Proveer datos falsos o fraudulentos.</li>
    <li>Intentar manipular la seguridad del sitio.</li>
    <li>Abuso de soporte o comunicaciones.</li>
    <li>Reventa o compartición no autorizada del contenido.</li>
    <li>Difamación o conducta ofensiva hacia NEMTOR LLC, sus empleados o la comunidad.</li>
</ul>

<h2>11. Comunidades y redes sociales</h2>
<p>NEMTOR LLC administra grupos de alumnos en redes sociales (Facebook, Instagram, WhatsApp). Se reserva el derecho de admisión, moderación y expulsión según un código de conducta que prohíbe acoso, spam, publicidad no autorizada o conductas inapropiadas.</p>

<h2>12. Modificaciones</h2>
<p>NEMTOR LLC se reserva el derecho de modificar estos términos en cualquier momento. Los cambios se publicarán en esta misma página con la fecha actualizada. El uso continuado del sitio tras los cambios implica tu aceptación de los nuevos términos.</p>

<h2>13. Jurisdicción y ley aplicable</h2>
<p>Las controversias que surjan del uso del sitio se someterán a la legislación del Estado de Delaware, Estados Unidos, y a los tribunales competentes de dicha jurisdicción, salvo disposición legal imperativa en contrario.</p>

<h2>14. Contacto</h2>
<p>Para cualquier consulta sobre estos términos, escribinos a .</p>

<div class="highlight">
    <strong>Responsable:</strong><br>
    NEMTOR LLC<br>
    Delaware, Estados Unidos<br>
    
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
        Contacto
    </div>
    <div class="footer-bottom">© 2026 NEMTOR LLC · Todos los derechos reservados</div>
</footer>

<!-- CHAT_IA_WIDGET -->
<?php include(dirname(__FILE__) . "/../a-includes/chat-widget.php"); ?>
</body>
</html>
