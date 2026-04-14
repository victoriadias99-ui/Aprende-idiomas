<?php
$country_code = trim($_SERVER["HTTP_CF_IPCOUNTRY"]);
if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    
//    echo "<pre>";
//    print_r($_SERVER);
//    echo "</pre>";
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

    use Ipdata\ApiClient\Ipdata;
    use Symfony\Component\HttpClient\Psr18Client;
    use Nyholm\Psr7\Factory\Psr17Factory;
    
if (isset($country_code) && $country_code != '') {
    
} else {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $ip = explode(',', str_replace(' ', '', $ip));

    if (isset($productoIP) && $productoIP != null) {
        //echo "1";
        $dataIP = getIP($ip[0], $productoIP);
        if ($dataIP == null) {
            //echo "2";
            $httpClient = new Psr18Client();
            $psr17Factory = new Psr17Factory();
            $ipdata = new Ipdata(Keys::$ipdataApi, $httpClient, $psr17Factory);
            $data = $ipdata->lookup($ip[0]);

            insertIP($ip[0], $productoIP, json_encode($data));
        } else {
            //echo "3";
            $data = json_decode($dataIP['data'], true);
            updateIP($ip[0], $productoIP, $dataIP['visitas'] + 1);
        }
    } else {

        $dataC = isset($curso) ? $curso : (isset($_GET['curso']) ? $_GET['curso'] : null);
        if ($dataC == null) {
            //echo "4";
            $httpClient = new Psr18Client();
            $psr17Factory = new Psr17Factory();
            $ipdata = new Ipdata(Keys::$ipdataApi, $httpClient, $psr17Factory);
            $data = $ipdata->lookup($ip[0]);
        } else {
            $dataIP = getIP($ip[0], $dataC);
            if ($dataIP == null) {
                //echo "5";
                $httpClient = new Psr18Client();
                $psr17Factory = new Psr17Factory();
                $ipdata = new Ipdata(Keys::$ipdataApi, $httpClient, $psr17Factory);
                $data = $ipdata->lookup($ip[0]);

                insertIP($ip[0], $dataC, json_encode($data));
            } else {
                //echo "6";
                $data = json_decode($dataIP['data'], true);
                updateIP($ip[0], $dataC, $dataIP['visitas'] + 1);
            }
        }
    }

    /*
      $ip = explode(',', str_replace(' ', '', $ip))[0];

      $httpClient = new Psr18Client();
      $psr17Factory = new Psr17Factory();
      $ipdata = new Ipdata(Keys::$ipdataApi, $httpClient, $psr17Factory);
      $data = $ipdata->lookup($ip);
     */

    /*
      echo "<pre>";
      print_r($data);
      echo "</pre>";
     */

    if (isset($_GET['test']))
        $test = $_GET['test'];
    else
        $test = 0;

    $urlRoot = "index.php";

    /*     * ** Desencripta el parametro data del get
     * moneda -> Tipo de moneda (ej: MX)
     * simbolo-> Simbolo de la maneda (ej: $)
     * code -> Codigo del pais (ej: MEX)
     * *** */

//OBLIGATORIOS
    if (isset($_GET['country'])) {
        switch ($_GET['country']) {
            case 'MX':
                $moneda = 'MXN';
                $simbolo = '$';
                $country = 'MX';
                break;
            default:
                $moneda = 'USD';
                $simbolo = '$';
                $country = $data['country_code'];
                break;
        }
    } else {
        $moneda = $data['currency']['code']; //isset($_data->moneda) ? $_data->moneda : null;
        $simbolo = $data['currency']['native']; //''; //isset($_data->simbolo) ? $_data->simbolo : null;
        $country = $data['country_code']; //isset($_data->code) ? $_data->code : null;
    }
}