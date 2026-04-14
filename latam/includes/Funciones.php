<?php
class Funciones {
    static function getFormatMoneda($val, $simbolo ,$moneda){
        $v1 = explode('.', $val . '');
        $_val = '';
        if(strlen($v1[0]) > 4){
            $_val = substr($v1[0], 0, -1) . '9';
        } else {
            $_val = $v1[0];
        }
        return $simbolo .$_val . ' ' . $moneda;
    }

    function getFloatFormat($val){
        return round($val);
    }
}