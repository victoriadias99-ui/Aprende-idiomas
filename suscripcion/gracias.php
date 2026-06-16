<?php
// Pagina de exito de la suscripcion (success URL de los Stripe Payment Links)
// Stripe debe redirigir aqui con: ?plan=mensual|anual&session_id={CHECKOUT_SESSION_ID}
$plan = isset($_GET['plan']) ? $_GET['plan'] : 'mensual';
$session = isset($_GET['session_id']) ? preg_replace('/[^A-Za-z0-9_]/', '', $_GET['session_id']) : ('sub_' . time());
$value = ($plan === 'anual') ? 24 : 4;
$contentName = ($plan === 'anual') ? 'suscripcion_anual' : 'suscripcion_mensual';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>¡Listo! Suscripción activada | Aprende Idiomas</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
    <meta name="theme-color" content="#0a0a0f">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Inter',sans-serif;background:#0a0a0f;color:#fff;min-height:100vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:24px}
        .card{max-width:560px}
        .check{font-size:64px;margin-bottom:16px}
        h1{font-family:'Sora',sans-serif;font-size:34px;font-weight:800;margin-bottom:16px;line-height:1.15}
        p{font-size:17px;line-height:1.6;color:#c8c8d4;margin-bottom:14px}
        .btn{display:inline-block;margin-top:22px;background:#e6007e;color:#fff;text-decoration:none;font-weight:700;padding:16px 32px;border-radius:12px;font-size:17px}
    </style>
</head>
<body>
    <div class="card">
        <div class="check">🎉</div>
        <h1>¡Tu suscripción está activa!</h1>
        <p>Recibirás los datos de acceso en tu e-mail dentro de los próximos minutos. Si no lo ves, revisá la carpeta de spam o no deseados.</p>
        <a class="btn" href="https://academia.aprende-idiomas.com/">Ir a la academia →</a>
    </div>

<!-- ========== TRACKING ========== -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-THQ2HVF');</script>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-THQ2HVF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- Facebook Pixel -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init','851421198669354');
fbq('init','177917573796998');
fbq('track','PageView');
fbq('track','Purchase',{
    value: <?= $value ?>,
    currency: 'USD',
    content_name: '<?= $contentName ?>'
},{eventID: '<?= $session ?>'});
fbq('trackCustom','suscripcion-exitosa',{eventID: '<?= $session ?>'});
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=851421198669354&ev=Purchase&noscript=1"></noscript>

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VE1K0ZKEG6"></script>
<script>
window.dataLayer=window.dataLayer||[];
function gtag(){dataLayer.push(arguments);}
gtag('js',new Date());
gtag('config','G-VE1K0ZKEG6');
gtag('config','UA-196494254-1');
gtag('event','purchase',{
    'transaction_id': '<?= $session ?>',
    'value': <?= $value ?>,
    'currency': 'USD',
    'items': [{'item_name': '<?= $contentName ?>','item_id': '<?= $plan ?>','price': <?= $value ?>,'quantity': 1}]
});
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-196494254-1"></script>
</body>
</html>
