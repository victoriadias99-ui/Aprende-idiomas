<?php
if(isset($_GET['test'])){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require_once dirname(__DIR__) . '/a-libraries/vendor/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

include("funcionsDBStripe.php");

$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$email = $_GET['email'];
$moneda = $_GET['metodoPago'] == 'payment-paypal' ? 'USD' : $_GET['moneda'];
$pais = $_GET['pais'];
$curso = $_GET['curso'];
$pack = $_GET['pack'];
$metodoPago = $_GET['metodoPago'];

if($moneda == 'ARS'){
    $r = getDataProductoCheckout($curso, 'ARS');
    $moneda = 'ARS';
} if($moneda == 'VES' || $moneda == 'PAB' || $moneda == 'HTG' || $moneda == 'GTQ' || $moneda == 'CRC'){
    $r = getDataProductoCheckout($curso, 'USD');
    $moneda = 'USD';
} else
    $r = getDataProductoCheckout($curso, $moneda);

$producto = $r['producto'];
$dataPack = $r['pack'];
$precioPago = $producto['PRECIO_DESC'];
// Rutas base tras plegar /latam al root
$urlLib = 'https://' . $_SERVER['HTTP_HOST'] . '/';
// urlCurso apunta al slug URL-friendly del curso (ID_ABRE usa _, path usa -)
$slugCurso = isset($_GET['slug']) && $_GET['slug'] !== '' ? $_GET['slug'] : str_replace('_', '-', $producto['ID_ABRE']);
$urlCurso = 'https://' . $_SERVER['HTTP_HOST'] . '/' . $slugCurso . '/';
if(isset($_GET['test'])){
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";
    echo "<pre>";
    print_r($r);
    echo "</pre>";
}
switch ($metodoPago) {
    case 'payment-paypal':
        $r = getDataProductoCheckout($curso, 'USD');

        $producto = $r['producto'];
        $dataPack = $r['pack'];
        $precioPago = $producto['PRECIO_DESC'];

        if ($producto['live'] == 1) {
            $apiContext = new ApiContext(new OAuthTokenCredential(
                    $producto['clientID'], $producto['idSecret']
            ));
            $apiContext->setConfig(array('mode' => 'live'));
        } else {
            
            $apiContext = new ApiContext(new OAuthTokenCredential(
                    $producto['clientIDTest'], $producto['idSecretTest']
            ));
            $apiContext->setConfig(array('mode' => 'sandbox'));
        }

        // Create new payer and method
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // Set redirect URLs
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($urlLib . 'a-includes/initPaymentPaypal.php')
                ->setCancelUrl($urlCurso . 'checkhout.php?curso=' . $producto['ID_ABRE']);
        
        $precioTotal = $precioPago;
        if($curso != $pack){
            $arrayPacks = explode('|', $pack);
            foreach ($dataPack as $p) {
                if (in_array($p['ID_ABRE'], $arrayPacks)) {
                    $precioTotal += $p['PRECIO'];
                }
            }
        }
        
        $amount = new Amount();
            $amount->setCurrency($moneda)
                    ->setTotal(intval($precioTotal));

        // Set transaction object
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setDescription($nombreProducto);

        // Create the full payment object
        $payment = new Payment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));

        // Create payment with valid API context
        try {
            $payment->create($apiContext);
            // Get PayPal redirect URL and redirect the customer
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo "<pre>";
            print_r($ex);
            echo "</pre>";
            die();
        } catch (Exception $ex) {
            echo "<pre>";
            print_r($ex);
            echo "</pre>";
            die();
        }
        $request = json_decode($payment->toJSON());
        $strData = $payment->toJSON();
        
        setVentaStripe($metodoPago, $curso, $pack,  $request->id, $precioTotal, $moneda, $pais, $nombre, $apellido, $email, 'pendiente', null);
        
        echo json_encode(['estatus' => 'done', 'tipoPago' => $metodoPago, 'url' => $payment->getApprovalLink(), 'data' => $request]);
        break;
    case 'payment-strype':
        $itemsPurchase = [];
        $precioTotal = 0;
        if($curso != $pack){
            $arrayPacks = explode('|', $pack);
            foreach ($dataPack as $p) {
                if (in_array($p['ID_ABRE'], $arrayPacks)) {
                    $_precioStripe = $p['PRECIO'] * 100;
                    switch ($moneda) {
                        case 'CLP':
                            $_precioStripe = $_precioStripe / 100;
                            break;
                    }
                    $itemsPurchase[] = [
                        'price_data' => [
                            'currency' => $moneda,
                            'product_data' => [
                                'name' => $p['NOMBRE'],
                                //'description' => $p['DESCRIPCION'],
                                //'images' => [$p['IMAGEN']],
                            ],
                            'unit_amount' => ($moneda == 'ARS' ? intval($_precioStripe / 1.6) : $_precioStripe),
                        ],
                        'quantity' => 1,
                    ];
                    $precioTotal += $_precioStripe;
                }
            }
        }

        $precioStripe = ($moneda == 'ARS' ? intval(($precioPago * 100) / 1.75) : ($precioPago * 100));
        switch ($moneda) {
            case 'CLP':
                $precioStripe = $precioStripe / 100;
                break;
        }

        $precioTotal += $precioStripe;
        if ($producto['live'] == 1) {
            $stripe = new \Stripe\StripeClient($producto['keySecretStripe']);
        } else {
            $stripe = new \Stripe\StripeClient($producto['keySecretStripeTest']);
        }

        $itemsPurchase[] = [
            'price_data' => [
                'currency' => $moneda,
                'product_data' => [
                    'name' => $producto['NOMBRE'],
                    //'description' => $producto['DESCRIPCION'],
                    //'images' => [$producto['IMAGEN']],
                ],
                'unit_amount' => $precioStripe,
            ],
            'quantity' => 1,
        ];

        if ($moneda != 'CLP')
            $precioTotal = $precioTotal / 100;

        $idTemp = uniqid();
        setVentaStripe($metodoPago, $curso, $pack, $idTemp, $precioTotal, $moneda, $pais, $nombre, $apellido, $email, 'pendiente', null);
        $_payment = getVentaStripe($idTemp);
        $request = $stripe->checkout->sessions->create([
            'success_url' => $urlLib . 'pago_exitoso.php?id=' . $_payment['ID'] .'&moneda=' . $_payment['MONEDA'],
            'cancel_url' => $urlCurso . 'checkout.php?curso=' . $producto['ID_ABRE'],
            'customer_email' => $email,
            'payment_method_types' => ['card'],
            'line_items' => $itemsPurchase,
            'allow_promotion_codes' => true,
            'mode' => 'payment',
            'payment_intent_data' => [ // Metadatos en el PaymentIntent
                'metadata' => [
                    'order_id' => $idTemp,
                ],
            ],
        ]);

        $strtData = json_encode($request);
        updVentaStripe($idTemp, $metodoPago, $curso, $pack, $idTemp, $precioTotal, $moneda, $pais, $nombre, $apellido, $email, 'pendiente', $strtData);

        echo json_encode(['estatus' => 'done', 'tipoPago' => $metodoPago, 'id' => $request['id'], 'data' => $request]);
}
?>