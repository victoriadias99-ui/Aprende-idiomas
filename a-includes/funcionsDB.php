<?php
include("conexion.php");
include("class.autonum.php");

function getTimer($_ip, $idCurso, $timezone) {
    $result = getIP($_ip, $idCurso);
    if ($result != null){
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

function updateIP($_ip, $idCurso, $count, $cache = null) {
    $cnx = OpenCon();
    $stmt = $cnx->prepare("UPDATE `ip_visita` SET `visitas` = ?, `cache` = ? WHERE `ip` = ? AND `id_producto` = ?");
    $stmt->bindValue(1, $count, PDO::PARAM_INT);
    $stmt->bindValue(2, $cache == null ? '' : $cache, PDO::PARAM_STR);
    $stmt->bindValue(3, $_ip, PDO::PARAM_STR);
    $stmt->bindValue(4, $idCurso, PDO::PARAM_STR);
    $stmt->execute();
}

function insertIP($_ip, $idCurso, $data = null, $cache = null) {
    $cnx = OpenCon();
    $stmt = $cnx->prepare("INSERT INTO `ip_visita`(`ip`, `id_producto`, `data`, `cache`) VALUES (?, ?, ?, ?)");
    $stmt->bindValue(1, $_ip, PDO::PARAM_STR);
    $stmt->bindValue(2, $idCurso, PDO::PARAM_STR);
    $stmt->bindValue(3, $data == null ? '' : $data, PDO::PARAM_STR);
    $stmt->bindValue(4, $cache == null ? '' : $cache, PDO::PARAM_STR);
    $stmt->execute();
}

function getIP($_ip, $idCurso) {
    $cnx = OpenCon();
    $stmt = $cnx->prepare("SELECT * FROM `ip_visita` WHERE `ip` = ? AND `id_producto` = ?");
    $stmt->bindValue(1, $_ip, PDO::PARAM_STR);
    $stmt->bindValue(2, $idCurso, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return count($rows) == 0 ? null : $rows[0];
}

function getVenta($idVenta) {
    $consulta = "SELECT * FROM `ventas` WHERE `ID` = '$idVenta'";
    //echo $consulta;
    $cnx = OpenCon();
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $idVenta, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return count($rows) == 0 ? null : $rows[0];
}

function getUpsells($idCurso, $upsell) {
    $cnx = OpenCon();
    $consulta = "SELECT * FROM cursos_pack where ID_ABRE=? and ID_ABRE_PACK=?;";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $idCurso, PDO::PARAM_STR);
    $stmt->bindValue(2, $upsell, PDO::PARAM_STR);
    $stmt->execute();
    $pack = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return count($pack) == 0 ? null : $pack[0];
}

function getCursoDetalle($idCurso){
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

function getCursoDetalleCheckout($idCurso){
    $cnx = OpenCon();
    
    $consulta = "SELECT * FROM cursos_detalle where CURSO=?;";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $idCurso, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $data = count($rows) == 0 ? null : $rows[0];
    
    $consulta = "SELECT * FROM cursos_pack where ID_ABRE=?;";
    $stmt = $cnx->prepare($consulta);
    $stmt->bindValue(1, $idCurso, PDO::PARAM_STR);
    $stmt->execute();
    $pack = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $data = [
        'producto' => $data,
        'pack' => $pack,
    ];
    return $data;
}
?>