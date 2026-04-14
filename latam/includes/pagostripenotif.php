<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
    
include("funcionsDBStripe.php");
include("logicintegromat.php");

if ($_GET['p'] == 'latam') {
    $bodyReceived = file_get_contents("php://input");
    $data = json_decode($bodyReceived . '');

    $arrayStatus = [
        'payment_intent.succeeded' => 'DONE',
        'payment_intent.payment_failed' => 'RECHAZADO',
        'payment_intent.canceled' => 'CANCELADO',
        'payment_intent.created' => 'CREADO',
        'payment_intent.partially_funded' => 'FUNDED',
        'payment_intent.payment_failed' => 'FAILED'
    ];

    $cnx = OpenCon();
    $consulta = "UPDATE `v2_ventas` SET `DATA`= '" . $bodyReceived . "', `STATUS`= '" . $arrayStatus[$data->type] . "' WHERE `ID_PAGO` = ?";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $data->data->object->metadata->order_id, PDO::PARAM_STR);
    $stmt->execute();

    $dataProducto = getDataPaymentEbanx($data->data->object->metadata->order_id);
    $r = getDataProducto($dataProducto['PRODUCTO'], $dataProducto['MONEDA']);
    $urlIntegromat = $r['producto']['integromat'];
    if ($dataProducto != null && $arrayStatus[$data->type] == 'DONE') {
        $data = [
            'price' => [
                'id' => $data->data->object->metadata->order_id,
                'unit_amount_decimal' => $dataProducto['MONTO'],
                'currency' => $dataProducto['MONEDA'],
                'country' => $dataProducto['PAIS'],
            ],
            'nombre' => $dataProducto['NOMBRE'],
            'apellido' => $dataProducto['NOMBRE'],
            'email' => $dataProducto['CORREO'],
            'payment' => 'STRIPE',
            'fecha' => $dataProducto['FECHA'],
            'curso' => $dataProducto['PRODUCTO'],
            'upsell' => $dataProducto['UPSELL'],
        ];

        sendDataIntegromat($data, $urlIntegromat);
    }
    /*
      else if ($dataProducto != null && $arrayStatus[$data->type] == 'RECHAZADO'){
      $data = [
      'price' => [
      'id' => $data->data->object->id,
      'unit_amount_decimal' => $dataProducto['MONTO'],
      'currency' => $dataProducto['MONEDA'],
      ],
      'nombre' => $dataProducto['NOMBRE'],
      'apellido' => $dataProducto['NOMBRE'],
      'email' => $dataProducto['CORREO'],
      'payment' => 'STRIPE',
      'fecha' => $dataProducto['FECHA'],
      'curso' => $dataProducto['PRODUCTO'],
      ];

      sendDataIntegromat($data, $urlIntegromatPR);
      }
     * 
     */
}
?>