<?php
include("variables.php");
include("funcionsDBStripe.php");
include("logicintegromat.php");

$bodyReceived = file_get_contents('php://input');
$data = json_decode($bodyReceived . '');

$arrayStatus = [
    'PAYMENT.SALE.COMPLETED' => 'DONE',
    'PAYMENT.SALE.DENIED' => 'DENEGADO',
    'PAYMENT.SALE.PENDING' => 'PENDIENTE',
    'PAYMENT.SALE.REFUNDED' => 'DEVUELTO',
];

if (isset($arrayStatus[$data->event_type])) {

$id = $data->resource->parent_payment;
    
$cnx = OpenCon();
$consulta = "UPDATE `v2_ventas` SET `DATA`= '" . $bodyReceived . "', `STATUS`= '" . $arrayStatus[$data->event_type] . "', `test`= '" . $data->event_type . "' WHERE `ID_PAGO` = ?";
$stmt = $cnx->prepare($consulta);
$stmt->bindValue(1, $id, PDO::PARAM_STR);
$stmt->execute();

$dataProducto = getDataPaymentEbanx($id);
$r = getDataProducto($dataProducto['PRODUCTO'], $dataProducto['MONEDA']);
$urlIntegromat = $r['producto']['integromat'];

if($dataProducto != null && $arrayStatus[$data->event_type] == 'DONE'){
    $data = [
        'price' => [
            'id' => $id,
            'unit_amount_decimal' => $dataProducto['MONTO'],
            'currency' => $dataProducto['MONEDA'],
        ],
        'nombre' => $dataProducto['NOMBRE'],
        'apellido' => $dataProducto['NOMBRE'],
        'email' => $dataProducto['CORREO'],
        'payment' => 'PAYPAL',
        'fecha' => $dataProducto['FECHA'],
        'curso' => $dataProducto['PRODUCTO'],
        'upsell' => $dataProducto['UPSELL'],
    ];

    sendDataIntegromat($data, $urlIntegromat);
}
}
?>
