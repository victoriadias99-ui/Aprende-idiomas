<?php
if(isset($_GET['test'])){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}

require_once '../vendor/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

include("funcionsDBStripe.php");

$token = $_GET['token'];
$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

$_payment = getVentaStripe($paymentId);
//echo "<pre>";
//print_r($_payment);
//echo "</pre>";
$producto = getDataProducto($_payment['PRODUCTO'], $_payment['MONEDA'])['producto'];
//echo "<pre>";
//print_r($producto);
//echo "</pre>";

$urlLib = 'https://' . $_SERVER['HTTP_HOST'] . '/dinamico/';

if ($producto['live'] == 1) {
    echo 'live<br>';
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

$payment = Payment::get($paymentId, $apiContext);

$execution = new \PayPal\Api\PaymentExecution();
$execution->setPayerId($payerId);

try {
    $result = $payment->execute($execution, $apiContext);

    $payment = Payment::get($paymentId, $apiContext);
    $transactions = $payment->getTransactions();
    $transaction = $transactions[0];
    $relatedResources = $transaction->getRelatedResources();
    $relatedResource = $relatedResources[0];
    $sale = $relatedResources[0]->getSale();
    $saleId = $sale->getId();

    $sale = \PayPal\Api\Sale::get($saleId, $apiContext);

    //$data['payment'] = $payment->toArray();
    $data['reference_id'] = $token;
    $data['payment_request_id'] = $paymentId;
    $data['payment_id'] = $sale->getID();
    $data['response'] = '{"invoice_no": ' . $sale->invoice_number . ', "method": "paypal"}';
    $data['payment_status'] = $sale->getState();
    
    updVentaStripe($_payment['ID_PAGO'], $_payment['TIPO_PAGO'], $_payment['PRODUCTO'], $_payment['UPSELL'], $_payment['ID_PAGO'], $_payment['MONTO'], $_payment['MONEDA'], $_payment['PAIS'], $_payment['NOMBRE'], $_payment['APELLIDO'], $_payment['CORREO'], $_payment['STATUS'], $_payment['DATA']);
    $_payment = getVentaStripe($paymentId);
    header('refresh:1;url=' . $urlLib . 'pago_exitoso.php?id=' . $_payment['ID'].'&moneda=USD');
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    //$data =  $ex->getData();
    updVentaStripe($_payment['ID_PAGO'], $_payment['TIPO_PAGO'], $_payment['PRODUCTO'], $_payment['UPSELL'], $_payment['ID_PAGO'], $_payment['MONTO'], $_payment['MONEDA'], $_payment['PAIS'], $_payment['NOMBRE'], $_payment['APELLIDO'], $_payment['CORREO'], 'ERROR001', str_replace("'", "", json_encode($ex->getData())));
    header('refresh:1;url=' . $urlLib . 'compra-rechazada/?id=' . $_payment['ID']);
    die();
} catch (Exception $ex) {
    updVentaStripe($_payment['ID_PAGO'], $_payment['TIPO_PAGO'], $_payment['PRODUCTO'], $_payment['UPSELL'], $_payment['ID_PAGO'], $_payment['MONTO'], $_payment['MONEDA'], $_payment['PAIS'], $_payment['NOMBRE'], $_payment['APELLIDO'], $_payment['CORREO'], 'ERROR001', str_replace("'", "", json_encode($ex->getData())));
    header('refresh:1;url=' . $urlLib . 'compra-error/');
    die();
}
?>
