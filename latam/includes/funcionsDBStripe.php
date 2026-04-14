<?php

include("conexion.php");
include("class.autonum.php");
require("Keys.php");

function getTimer($_ip, $idCurso, $timezone) {
    $result = getIP($_ip, $idCurso);
    if ($result != null) {
        $dateNow = date('Y-m-d H:i:s');
        $dateRegistro = $result['fecha_registro'];

        $date1 = new DateTime($dateRegistro);
        $date2 = new DateTime("now");
        $diff = $date1->diff($date2);

        $minutos = $diff->days * 24 * 60;
        $minutos += $diff->h * 60;
        $minutos += $diff->i;

        $date1 = new DateTime($dateRegistro, new DateTimeZone(date_default_timezone_get()));
        $date1->setTimezone(new DateTimeZone($timezone));

        return [
            'minutos' => intval($minutos),
            'date' => $date1,
        ];
    }
    return -1;
}

function updateIP($_ip, $idCurso, $count) {
    $cnx = OpenCon();
    $consulta = "UPDATE `ip_visita` SET `visitas` = $count WHERE `ip` = '$_ip' and `id_producto` ='" . $idCurso . "'";
    $stmt = $cnx->prepare($consulta);
    $stmt->execute();
}

function insertIP($_ip, $idCurso, $data = null) {
    $cnx = OpenCon();
    $consulta = "INSERT INTO `ip_visita`(`ip`, `id_producto`, `data`) VALUES ('$_ip', '$idCurso', '" . ($data == null ? '' : $data) . "')";
    $stmt = $cnx->prepare($consulta);
    $stmt->execute();
}

function getIP($_ip, $idCurso) {
    $consulta = "SELECT * FROM `ip_visita` WHERE `ip` = '$_ip' and `id_producto` ='" . $idCurso . "'";

    $cnx = OpenCon();
    $stmt = $cnx->prepare($consulta);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return count($rows) == 0 ? null : $rows[0];
}

function getCursoDetalle($idCurso) {
    $consulta = "SELECT * FROM cursos_detalle where CURSO=?;";
    //echo  "SELECT * FROM cursos_detalle where CURSO='$idCurso';<br>";

    $cnx = OpenCon();
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $idCurso, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //echo 'count($rows) = ' . count($rows) .'<br>';
    $data = count($rows) == 0 ? null : $rows[0];
    return $data;
}

function getDataProductoByID($curso, $moneda = null) {
    $consulta = "SELECT 
                    p.*
                    FROM v2_producto as p
                    WHERE p.ID_PRODUCTO=?";
    $cnx = OpenCon();
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $curso, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return count($rows) == 0 ? null : $rows[0];
}

function updVentaStripe($idPagoOld, $tipopago, $producto, $upsell, $idPago, $monto, $moneda, $pais, $nombre, $apellido, $correo, $status, $data) {
    $cnx = OpenCon();
    $consulta = "UPDATE `v2_ventas` SET "
            . "`TIPO_PAGO`=?,"
            . "`PRODUCTO`=?,"
            . "`UPSELL`=?,"
            . "`ID_PAGO`=?,"
            . "`MONTO`=?,"
            . "`MONEDA`=?,"
            . "`PAIS`=?,"
            . "`NOMBRE`=?,"
            . "`CORREO`=?,"
            . "`STATUS`=?,"
            . "`DATA`=? "
            . "WHERE ID_PAGO = '" . $idPagoOld . "'";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $tipopago, PDO::PARAM_STR);
    $stmt->bindValue(2, $producto, PDO::PARAM_STR);
    $stmt->bindValue(3, $upsell, PDO::PARAM_STR);
    $stmt->bindValue(4, $idPago, PDO::PARAM_STR);
    $stmt->bindValue(5, $monto, PDO::PARAM_INT);
    $stmt->bindValue(6, $moneda, PDO::PARAM_STR);
    $stmt->bindValue(7, $pais, PDO::PARAM_STR);
    $stmt->bindValue(8, $nombre . ' ' . $apellido, PDO::PARAM_STR);
    $stmt->bindValue(9, $correo, PDO::PARAM_STR);
    $stmt->bindValue(10, $status, PDO::PARAM_STR);
    $stmt->bindValue(11, $data, PDO::PARAM_STR);
    $stmt->execute();
}

function getVentaStripe($idVenta) {
    $consulta = "SELECT * FROM `v2_ventas` WHERE `ID_PAGO` = ?";
    $cnx = OpenCon();
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $idVenta, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return count($rows) == 0 ? null : $rows[0];
}

function setVentaStripe($metodoPago, $curso, $pack, $idTemp, $precioTotal, $moneda, $pais, $nombre, $apellido, $email, $status, $data) {
    $cnx = OpenCon();
    $consulta = "INSERT INTO 
        `v2_ventas`(
        `TIPO_PAGO`, `PRODUCTO`, `UPSELL`, `ID_PAGO`, `FECHA`, `MONTO`, `MONEDA`, `PAIS`, `NOMBRE`, `CORREO`, `STATUS`, `DATA`) VALUES 
        (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $metodoPago, PDO::PARAM_STR);
    $stmt->bindValue(2, $curso, PDO::PARAM_STR);
    $stmt->bindValue(3, $pack, PDO::PARAM_STR);
    $stmt->bindValue(4, $idTemp, PDO::PARAM_STR);
    $stmt->bindValue(5, date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->bindValue(6, $precioTotal, PDO::PARAM_STR);
    $stmt->bindValue(7, $moneda, PDO::PARAM_STR);
    $stmt->bindValue(8, $pais, PDO::PARAM_STR);
    $stmt->bindValue(9, $nombre . ' ' . $apellido, PDO::PARAM_STR);
    $stmt->bindValue(10, $email, PDO::PARAM_STR);
    $stmt->bindValue(11, $status, PDO::PARAM_STR);
    $stmt->bindValue(12, $data, PDO::PARAM_STR);
    $stmt->execute();
}

function setVenta($producto, $hottok, $monto, $moneda, $nombre, $correo, $data) {
    $cnx = OpenCon();
    $consulta = "INSERT INTO 
        `v2_ventas`(
        `TIPO_PAGO`, `PRODUCTO`, `ID_PAGO`, `FECHA`, `MONTO`, `MONEDA`, `PAIS`, `NOMBRE`, `CORREO`, `STATUS`, `DATA`) VALUES 
        ('hotmart',?,?,?,?,?,'SP',?,?,'DONE',?)";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $producto, PDO::PARAM_STR);
    $stmt->bindValue(2, $hottok, PDO::PARAM_STR);
    $stmt->bindValue(3, date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->bindValue(4, $monto, PDO::PARAM_STR);
    $stmt->bindValue(5, $moneda, PDO::PARAM_STR);
    $stmt->bindValue(6, $nombre, PDO::PARAM_STR);
    $stmt->bindValue(7, $correo, PDO::PARAM_STR);
    $stmt->bindValue(8, $data, PDO::PARAM_STR);
    $stmt->execute();
}

function getLatam() {
    $consulta = "SELECT MONEDA FROM v2_producto where LATAM = 1";
    $cnx = OpenCon();
    $stmt = $cnx->prepare($consulta);
    $stmt->execute();
    $moneda = [];
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $item) {
        $moneda[] = $item['MONEDA'];
    }
    return $moneda;
}

function getLast() {
    $consulta = "SELECT max(ID) FROM v2_ventas";

    $cnx = OpenCon();
    $stmt = $cnx->prepare($consulta);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = $rows[0] + 1;
    return $data;
}

function getDataPaymentByID($id) {
    $consulta = "SELECT * FROM v2_ventas where ID=?;";

    $cnx = OpenCon();
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $id, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = count($rows) == 0 ? null : $rows[0];
    return $data;
}

function getDataPaymentEbanx($idPayment) {
    $consulta = "SELECT * FROM v2_ventas where ID_PAGO=?;";

    $cnx = OpenCon();
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $idPayment, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = count($rows) == 0 ? null : $rows[0];
    return $data;
}

function getDataProducto($curso, $moneda, $pais = null) {
    $cnx = OpenCon();

    $consulta = "SELECT * FROM v2_producto_precios where ID_ABRE=? and " . ($pais != null ? 'PAIS' : 'MONEDA') . " = ?;";
    $stmt1 = $cnx->prepare($consulta);
    $stmt1->bindValue(1, $curso, PDO::PARAM_STR);
    $stmt1->bindValue(2, ($pais != null ? $pais : $moneda), PDO::PARAM_STR);
    $stmt1->execute();
    $rowsStmt1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    
     if (count($rowsStmt1) == 0){
        $moneda = 'USD';
        $pais = null;
        $consulta = "SELECT * FROM v2_producto_precios where ID_ABRE=? and 'MONEDA' = ?;";
        $stmt1 = $cnx->prepare($consulta);
        $stmt1->bindValue(1, $curso, PDO::PARAM_STR);
        $stmt1->bindValue(2, $moneda, PDO::PARAM_STR);
        $stmt1->execute();
        $rowsStmt1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }

    if (false/* (count($rowsStmt1) == 0) || (count($rowsStmt1) > 0 && $rowsStmt1[0]['ESTATICO'] == 0) */) {
        $consulta = "SELECT count(*) as CONTEO FROM v2_producto_precios where ID_ABRE=? and MONEDA = ? and DATE(updated) = ?;";
        $stmt1 = $cnx->prepare($consulta);
        $stmt1->bindValue(1, $curso, PDO::PARAM_STR);
        $stmt1->bindValue(2, $moneda, PDO::PARAM_STR);
        $stmt1->bindValue(3, date('Y-m-d'), PDO::PARAM_STR);
        $stmt1->execute();
        $rowsStmt1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        if ($rowsStmt1[0]['CONTEO'] == 0 && $moneda != 'USD') {
            $consulta = "SELECT * FROM v2_producto_precios where ID_ABRE=? and MONEDA=?;";
            $stmt2 = $cnx->prepare($consulta);
            $stmt2->bindValue(1, $curso, PDO::PARAM_STR);
            $stmt2->bindValue(2, 'USD', PDO::PARAM_STR);
            $stmt2->execute();
            $rowsStmt2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            $result = file_get_contents('https://v6.exchangerate-api.com/v6/0dbbd4b141102744eb8a83e0/latest/USD');
            $array = json_decode($result, true);
            $convDolar = $array['conversion_rates'][$moneda];
            /*
              $result = file_get_contents('http://api.currencylayer.com/live?access_key=4fb748216ac0713e9285cd9d773caf14&format=1');
              $array = json_decode($result, true);
              $convDolar = $array['quotes']['USD' . $moneda];
             * 
             */

            if ($convDolar > 0) {
                $_precio_ = $rowsStmt2[0]['PRECIO'] * $convDolar;
                $_precioDesc_ = $rowsStmt2[0]['PRECIO_DESC'] * $convDolar;
                $_moneda_ = $moneda;

                $consulta = "DELETE FROM `v2_producto_precios` WHERE ID_PRODUCTO=? and ID_ABRE=? and MONEDA=?;";
                $stmt = $cnx->prepare($consulta);
                $stmt->bindValue(1, $rowsStmt2[0]['ID_PRODUCTO'], PDO::PARAM_STR);
                $stmt->bindValue(2, $rowsStmt2[0]['ID_ABRE'], PDO::PARAM_STR);
                $stmt->bindValue(3, $_moneda_, PDO::PARAM_STR);
                $stmt->execute();

                $consulta = "INSERT INTO `v2_producto_precios`"
                        . "(`ID_PRODUCTO`, `ID_ABRE`, `PRECIO`, `PRECIO_DESC`, `MONEDA`,`ESTATICO`) VALUES "
                        . "(?,?,?,?,?,?)";
                $stmt = $cnx->prepare($consulta);
                $stmt->bindValue(1, $rowsStmt2[0]['ID_PRODUCTO'], PDO::PARAM_STR);
                $stmt->bindValue(2, $rowsStmt2[0]['ID_ABRE'], PDO::PARAM_STR);
                $stmt->bindValue(3, $_precio_, PDO::PARAM_STR);
                $stmt->bindValue(4, $_precioDesc_, PDO::PARAM_STR);
                $stmt->bindValue(5, $_moneda_, PDO::PARAM_STR);
                $stmt->bindValue(6, 0, PDO::PARAM_STR);
                $stmt->execute();

                $consulta = "SELECT count(*) as CONTEO FROM v2_producto_precios where ID_ABRE=? and MONEDA=? and DATE(updated) = ?;";
                $stmt1 = $cnx->prepare($consulta);
                $stmt1->bindValue(1, $curso, PDO::PARAM_STR);
                $stmt1->bindValue(2, $moneda, PDO::PARAM_STR);
                $stmt1->bindValue(3, date('Y-m-d'), PDO::PARAM_STR);
                $stmt1->execute();
                $rowsStmt1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }

    $consulta = "SELECT 
                    p.ID,
                    p.ID_ABRE,
                    p.ID_PRODUCTO,
                    p.IMAGEN,
                    p.IMAGEN,
                    p.DESCRIPCION,
                    p.live,
                    p.integromat,
                    p.keySecretStripe,
                    p.keySecretStripeTest,
                    p.keyPublicStripe,
                    p.keyPublicStripeTest,
                    p.clientID,
                    p.clientIDTest,
                    p.idSecret,
                    p.idSecretTest,
                    pp.LATAM,
                    pp.SIMBOLO,
                    pp.MONEDA,
                    p.NOMBRE,
                    p.OFERTA,
                    pp.PRECIO,
                    pp.PRECIO_DESC,
                    pp.ESTATICO,
                    pp.updated
                    FROM v2_producto as p
                    JOIN v2_producto_precios as pp ON pp.ID_PRODUCTO = p.ID_PRODUCTO and pp.ID_ABRE = p.ID_ABRE
                    WHERE p.ID_ABRE=? and pp." . ($pais != null ? 'PAIS' : 'MONEDA') . "=?;";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $curso, PDO::PARAM_STR);
    $stmt->bindValue(2, ($pais != null ? $pais : $moneda), PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [
        'producto' => count($rows) == 0 ? null : $rows[0],
    ];
    return $data;
}

function getDataProductoCheckout($curso, $moneda, $pais = null) {
    $p = getDataProducto($curso, $moneda, $pais);
    
    $moneda = $p['producto']['MONEDA'];
    $pais = $p['producto']['PAIS'];
    
    if ($pais != null) {
        $moneda = $p['producto']['MONEDA'];
    }
    $cnx = OpenCon();
    $consulta = "SELECT * FROM v2_producto_pack where ID_ABRE=?;";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $curso, PDO::PARAM_STR);
    $stmt->execute();
    $rows2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pack = [];

    foreach ($rows2 as $item) {
        $consulta = 'SELECT * FROM v2_producto_pack_precios where ID_ABRE=? and ID_ABRE_PACK=? and MONEDA=?;';
        $stmt = $cnx->prepare($consulta);
        $stmt->bindValue(1, $item['ID_ABRE'], PDO::PARAM_STR);
        $stmt->bindValue(2, $item['ID_ABRE_PACK'], PDO::PARAM_STR);
        $stmt->bindValue(3, $moneda, PDO::PARAM_STR);
        $stmt->execute();
        $rowsPP = $stmt->fetchAll(PDO::FETCH_ASSOC);
        /*
          if($rowsPP[0]['ESTATICO'] == 0){
          if($moneda != 'USD')
          $consulta = 'SELECT * FROM v2_producto_pack_precios where ID_ABRE=? and ID_ABRE_PACK=? and MONEDA=? and DATE(updated) = ?;';
          else
          $consulta = 'SELECT * FROM v2_producto_pack_precios where ID_ABRE=? and ID_ABRE_PACK=? and MONEDA=?;';
          $stmt = $cnx->prepare( $consulta );
          $stmt->bindValue(1, $item['ID_ABRE'], PDO::PARAM_STR );
          $stmt->bindValue(2, $item['ID_ABRE_PACK'], PDO::PARAM_STR );
          $stmt->bindValue(3, $moneda, PDO::PARAM_STR );
          if($moneda != 'USD')
          $stmt->bindValue(4, date('Y-m-d'), PDO::PARAM_STR);
          $stmt->execute();
          $rowsP = $stmt->fetchAll( PDO::FETCH_ASSOC );

          if (count($rowsP) == 0 && $moneda != 'USD'){
          $consulta = 'SELECT * FROM v2_producto_pack_precios where ID_ABRE=? and ID_ABRE_PACK=? and MONEDA=?;';
          $stmt2 = $cnx->prepare( $consulta );
          $stmt2->bindValue(1, $item['ID_ABRE'], PDO::PARAM_STR );
          $stmt2->bindValue(2, $item['ID_ABRE_PACK'], PDO::PARAM_STR );
          $stmt2->bindValue(3, 'USD', PDO::PARAM_STR );
          $stmt2->execute();
          $rowsP2 = $stmt2->fetchAll( PDO::FETCH_ASSOC );


          $result = file_get_contents('https://v6.exchangerate-api.com/v6/0dbbd4b141102744eb8a83e0/latest/USD');
          $array = json_decode($result, true);
          $convDolar = $array['conversion_rates'][$moneda];

          /*
          $result = file_get_contents('http://api.currencylayer.com/live?access_key=4fb748216ac0713e9285cd9d773caf14&format=1');
          $array = json_decode($result, true);
          $convDolar = $array['quotes']['USD' . $moneda];
         */
        /*
          if($convDolar > 0){
          $_precio_ = $rowsP2[0]['PRECIO'] * $convDolar;
          //$_precioDesc_ = $rowsP2[0]['PRECIO_DESC'] * $convDolar;
          $_moneda_ = $moneda;

          $consulta = "DELETE FROM `v2_producto_pack_precios` WHERE ID_ABRE=? and ID_ABRE_PACK=? and MONEDA=?;";
          $stmt = $cnx->prepare($consulta);
          $stmt->bindValue(1, $rowsP2[0]['ID_ABRE'], PDO::PARAM_STR);
          $stmt->bindValue(2, $rowsP2[0]['ID_ABRE_PACK'], PDO::PARAM_STR);
          $stmt->bindValue(3, $_moneda_, PDO::PARAM_STR);
          $stmt->execute();

          $consulta = "INSERT INTO `v2_producto_pack_precios`"
          . "(`ID_ABRE_PACK`, `ID_ABRE`, `PRECIO`, `MONEDA`) VALUES "
          . "(?,?,?,?)";
          $stmt = $cnx->prepare($consulta);
          $stmt->bindValue(1, $rowsP2[0]['ID_ABRE_PACK'], PDO::PARAM_STR);
          $stmt->bindValue(2, $rowsP2[0]['ID_ABRE'], PDO::PARAM_STR);
          $stmt->bindValue(3, $_precio_, PDO::PARAM_STR);
          $stmt->bindValue(4, $_moneda_, PDO::PARAM_STR);
          $stmt->execute();
          } else {
          getDataProductoCheckout($curso, 'USD');
          }
          }
          }

          if($rowsPP[0]['ESTATICO'] == 0){
          if($moneda != 'USD')
          $consulta = 'SELECT
          pp.ID_ABRE_PACK,
          pp.TITULO_1,
          pp.TITULO_2,
          pp.DESCRIPCION,
          ppv.PRECIO,
          ppv.MONEDA
          FROM v2_producto_pack as pp
          JOIN v2_producto_pack_precios ppv ON pp.ID_ABRE_PACK = ppv.ID_ABRE_PACK AND pp.ID_ABRE = ppv.ID_ABRE
          WHERE pp.ID_ABRE=? and pp.ID_ABRE_PACK=? and ppv.MONEDA=? and DATE(ppv.updated) = ?;';
          else
          $consulta = 'SELECT
          pp.ID_ABRE_PACK,
          pp.TITULO_1,
          pp.TITULO_2,
          pp.DESCRIPCION,
          ppv.PRECIO,
          ppv.MONEDA
          FROM v2_producto_pack as pp
          JOIN v2_producto_pack_precios ppv ON pp.ID_ABRE_PACK = ppv.ID_ABRE_PACK AND pp.ID_ABRE = ppv.ID_ABRE
          WHERE pp.ID_ABRE=? and pp.ID_ABRE_PACK=? and ppv.MONEDA=?;';
          }
          else {
          $consulta = 'SELECT
          pp.ID_ABRE_PACK,
          pp.TITULO_1,
          pp.TITULO_2,
          pp.DESCRIPCION,
          ppv.PRECIO,
          ppv.MONEDA
          FROM v2_producto_pack as pp
          JOIN v2_producto_pack_precios ppv ON pp.ID_ABRE_PACK = ppv.ID_ABRE_PACK AND pp.ID_ABRE = ppv.ID_ABRE
          WHERE pp.ID_ABRE=? and pp.ID_ABRE_PACK=? and ppv.MONEDA=?;';
          }
         * 
         */

        $consulta = 'SELECT 
                        pp.ID_ABRE_PACK,
                        pp.TITULO_1,
                        pp.TITULO_2,
                        pp.DESCRIPCION,
                        ppv.PRECIO,
                        ppv.MONEDA
                        FROM v2_producto_pack as pp
                        JOIN v2_producto_pack_precios ppv ON pp.ID_ABRE_PACK = ppv.ID_ABRE_PACK AND pp.ID_ABRE = ppv.ID_ABRE
                        WHERE pp.ID_ABRE=? and pp.ID_ABRE_PACK=? and ppv.MONEDA=?;';

        $stmt = $cnx->prepare($consulta);
        $stmt->bindValue(1, $item['ID_ABRE'], PDO::PARAM_STR);
        $stmt->bindValue(2, $item['ID_ABRE_PACK'], PDO::PARAM_STR);
        $stmt->bindValue(3, $moneda, PDO::PARAM_STR);
//        if($rowsPP[0]['ESTATICO'] == 0){
//            if($moneda != 'USD')
//                $stmt->bindValue(4, date('Y-m-d'), PDO::PARAM_STR);
//        }
        $stmt->execute();
        $rowsP = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pack[] = [
            'ID_ABRE' => $rowsP[0]['ID_ABRE_PACK'],
            'NOMBRE' => $rowsP[0]['TITULO_1'],
            'PRECIO' => $rowsP[0]['PRECIO'],
            'MONEDA' => $moneda,
            'TITULO' => $rowsP[0]['TITULO_2'],
            'DESCRIPCION' => $rowsP[0]['DESCRIPCION']
        ];
    }
    //echo $p['producto']['ESTATICO'];
    /*
      if($p['producto']['ESTATICO'] == 0){
      $consulta = "SELECT * FROM v2_producto_code_hotmart where ids like '%|$curso|%' and moneda is null;";
      $stmt = $cnx->prepare($consulta);
      $stmt->execute();
      $rows3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
      $consulta = "SELECT * FROM v2_producto_code_hotmart where ids like '%|$curso|%' and moneda = '$moneda';";
      $stmt = $cnx->prepare($consulta);
      $stmt->execute();
      $rows3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } */

    $consulta = "SELECT * FROM v2_producto_code_hotmart where ids like '%|$curso|%' and moneda = '$moneda';";
    $stmt = $cnx->prepare($consulta);
    $stmt->execute();
    $rows3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [
        'producto' => $p['producto'],
        'pack' => $pack,
        'packCodes' => $rows3,
    ];
    return $data;
}

?>