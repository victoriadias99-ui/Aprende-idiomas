<?php
$modeLive = false;

if($modeLive){
    //LIVE
    $paypalWebhubId = '9VE25985ML620260D';
    $paypalClientId = 'Af2i_hwcXg1ZUZBra9UXnIfVdy5uwEZfnVp4Qt6dziSy2fhZMTTZmuS2BfOg8gOCOYOSWfT0AGg29HrV';
    $paypalClientSecret = 'EBrYeuJWipAO338rtVNnHtT48uwoUFTxS73GSSuFd-bh6lLlmS10-6mNyOVYDJIz3ni-dG1ddGdOIVXu';
    
    $urlEbanx = 'https://api.ebanxpay.com/ws/query';
    $integrationKeyEbanx = 'live_ik_ykGfHJN_bGatIB79XaCL6w';
    
    $keyPublicStripe = 'pk_live_q69mxhsSG80h3oDLtlIqRGfO00j5Kwq2Oj'; 
} else {
    //SANBOX
    $paypalWebhubId = '43B96678SM696930T';
    $paypalClientId = 'AXFbHW35GnqSAAyRDwV8KsRqoWaNC2_HH1y7Iqhj0kK-MDMvqoQueGoe5Ctte57qt9VxnjQmnELw45ir';
    $paypalClientSecret = 'EIFw9YS3eoh2JPBd465zV1X88wUnZEIIiqxTZYt6p4o2eJI4I7AukOYImjx7hLJBy680JxfKvNi-rkMS';
    
    $urlEbanx = 'https://sandbox.ebanxpay.com/ws/query';
    $integrationKeyEbanx = 'test_ik_ltD0E4vr2848kpO-7a1_KQ';
    
    $keyPublicStripe = 'pk_test_p9rVEaYmtjsc3h9N8IXysNDR00tYrsHz3p'; 
}
$urlSitio = 'https://aprende-yoga.com/V2/';
//Checkout
$urlIntegromat = 'https://hook.integromat.com/l2gsznummhekf59ugyyb2568rx4z8u0t';
//CarritoAbandonado
$urlIntegromatKA = 'https://hook.integromat.com/7frb8zni8nxx83j4s1tbu2ax68h7xlh5';