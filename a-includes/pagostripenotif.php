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
        // Crea el usuario y manda el mail de bienvenida AUNQUE el escenario de
        // Make falle. El endpoint /idiomas fija la academia; es idempotente
        // (si el usuario ya existe, solo suma el curso, no reenvía credenciales).
        // URL/secret salen de env (Railway); no rompe el webhook si falla.
        $academiaUrl    = getenv('ACADEMIA_URL') ?: 'https://academia-production-c4cc.up.railway.app';
        $academiaSecret = getenv('ACADEMIA_WEBHOOK_SECRET_IDIOMAS') ?: (getenv('WEBHOOK_SECRET') ?: '');
        $cursosAcademia = array_values(array_unique(array_filter(array_merge(
            [$dataProducto['PRODUCTO']],
            explode('|', (string) $dataProducto['UPSELL'])
        ))));
        $payloadAcademia = json_encode([
            'email'    => $dataProducto['CORREO'],
            'nombre'   => $dataProducto['NOMBRE'],
            'cursos'   => $cursosAcademia,
            'monto'    => $dataProducto['MONTO'],
            'moneda'   => $dataProducto['MONEDA'],
            'academia' => 'idiomas',
        ]);
        $headersAcademia = ['Content-Type: application/json'];
        if ($academiaSecret !== '') {
            $headersAcademia[] = 'x-webhook-secret: ' . $academiaSecret;
        }
        $ch = curl_init(rtrim($academiaUrl, '/') . '/api/webhook/purchase/idiomas');
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payloadAcademia,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_HTTPHEADER     => $headersAcademia,
        ]);
        $respAcademia = curl_exec($ch);
        $codeAcademia = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($respAcademia === false || $codeAcademia >= 300) {
            error_log('[pagostripenotif] alta academia fallo: HTTP ' . $codeAcademia
                . ' | ' . curl_error($ch) . ' | ' . $respAcademia);
        }
        curl_close($ch);
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