<?php
// ─────────────────────────────────────────────────────────────────────────
// WEBHOOK DE STRIPE — ruta correcta (configurar en Stripe → Developers → Webhooks):
//   https://www.aprende-idiomas.com/a-includes/pagostripenotif.php?p=latam
// OJO: la ruta vieja /latam/includes/pagostripenotif.php fue ELIMINADA al
// unificar /latam al root (commit cd71322). Si el webhook apunta ahí, Stripe
// recibe HTTP 500 y el usuario NO se crea en la academia. El fallback de
// pago_exitoso.php cubre ese caso, pero la URL del webhook debe quedar correcta.
// Eventos requeridos: payment_intent.succeeded.
// ─────────────────────────────────────────────────────────────────────────
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
    $stmt = $cnx->prepare("UPDATE `v2_ventas` SET `DATA`= ?, `STATUS`= ? WHERE `ID_PAGO` = ?");
    $stmt->bindValue(1, $bodyReceived, PDO::PARAM_STR);
    $stmt->bindValue(2, $arrayStatus[$data->type] ?? 'UNKNOWN', PDO::PARAM_STR);
    $stmt->bindValue(3, $data->data->object->metadata->order_id, PDO::PARAM_STR);
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

        // ─── Alta directa en la academia (red de seguridad) ───────────
        // Crea el usuario y manda el mail de credenciales AUNQUE el escenario
        // de Make falle. Idempotente: si el usuario ya existe solo suma el
        // curso, no reenvía credenciales. Mismo alta que dispara pago_exitoso.php
        // (doble chance independiente: si el webhook no llega, igual se crea).
        $cursosAcademia = array_merge(
            [$dataProducto['PRODUCTO']],
            explode('|', (string) $dataProducto['UPSELL'])
        );
        enviarAltaAcademia(
            $dataProducto['CORREO'],
            $dataProducto['NOMBRE'],
            $cursosAcademia,
            $dataProducto['MONTO'],
            $dataProducto['MONEDA']
        );
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