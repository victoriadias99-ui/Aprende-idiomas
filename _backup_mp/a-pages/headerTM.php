<?php ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<!-- FavIcon-->
<link rel="apple-touch-icon" sizes="180x180" href="<?= $dirpage ?>fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= $dirpage ?>fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= $dirpage ?>fav/favicon-16x16.png">
<link rel="icon" type="image/png" sizes="128x128" href="<?= $dirpage ?>fav/fav.png">
<link rel="manifest" href="<?= $dirpage ?>fav/site.webmanifest">
<link rel="mask-icon" href="<?= $dirpage ?>fav/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<!-- Bootstrap core CSS -->
<link href="<?= $dirpage ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Website core CSS -->
<link href="<?= $dirpage ?>vendor/css/app.css" rel="stylesheet">
<!-- Animation CSS -->
<link href="<?= $dirpage ?>vendor/css/animate.css" rel="stylesheet">
<link href="<?= $dirpage ?>vendor/css/hover.css" rel="stylesheet">
<!-- Website Fonts -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous">

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W3NBJXZ');</script>
<!-- End Google Tag Manager -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-W6B8EM5GEW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-W6B8EM5GEW');
</script>

<!-- Pinterest Tag --><script>!function(e){if(!window.pintrk){window.pintrk = function () {window.pintrk.queue.push(Array.prototype.slice.call(arguments))};var
  n=window.pintrk;n.queue=[],n.version="3.0";var
  t=document.createElement("script");t.async=!0,t.src=e;var
  r=document.getElementsByTagName("script")[0];
  r.parentNode.insertBefore(t,r)}}("https://s.pinimg.com/ct/core.js");pintrk('load', '2613919052836', {em: '<user_email_address>'});pintrk('page');</script><noscript><img height="1" width="1" style="display:none;" alt=""
  src="https://ct.pinterest.com/v3/?event=init&tid=2613919052836&pd[em]=<hashed_email_address>&noscript=1" /></noscript><!-- end Pinterest Tag -->
  <script>
 pintrk('track', 'pagevisit');
</script>

<style>
    #banner-timer{
        background-color: black;
        color: wheat;
    }
    #banner-timer h5{
        text-align: center;
        font-weight: 700;
    }


    #mobile-alert {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: var(--bg-black-main);
        color: #fff;
        z-index: 15;
        animation: fadeIn 0.5s ease;
        background-color: black;
    }

    @media screen and (min-width:341px){
        #mobile-alert  {
            display: block;
        }
        #mobile-alert .precio-antes-p{
            font-size: 0.8em;
        }
        #mobile-alert .precio{
            font-size: 1em;
            color: #fff;
        }
        #mobile-alert   .btn-buy{
            font-size: 0.9em;
                background-color: #f3c910;
    width: 100%;
    font-weight: bolder;
        }

    }
</style>
<?php
$currentUrl = $_SERVER['REQUEST_URI'];

if (strpos($currentUrl, 'checkout') !== false) {
  echo "<script>
  pintrk('track', 'AddToCart');
 </script>";
}
?>

