<?php
require_once  dirname(__DIR__) . '/a-libraries/vendor/autoload.php';

/*
// Verificar si la URL actual no contiene '/latam' después del dominio
if (strpos($_SERVER['REQUEST_URI'], '/latam') !== 0) {
    // Construir la URL objetivo con '/latam'
    $target_url = "https://" . $_SERVER['HTTP_HOST'] . '/latam' . $_SERVER['REQUEST_URI'];

    // Obtener los encabezados de la URL para verificar si existe
    $headers = @get_headers($target_url);

    if ($headers && strpos($headers[0], '200') !== false) {
        // Si la URL existe, redirigir a esa URL
        header("Location: " . $target_url);
    } else {
        // Si la URL no existe, redirigir a /latam raíz
        header("Location: https://" . $_SERVER['HTTP_HOST'] . '/latam');
    }
    die();
}

*/
/** Inicio Explicación 1 **/
/***
 * Librerias necesarias para el funcionamiento de la geolocalización
 * **/
use Ipdata\ApiClient\Ipdata;
use Symfony\Component\HttpClient\Psr18Client;
use Nyholm\Psr7\Factory\Psr17Factory;

/***
 * Fragmento de codigo que optiene la ip del cliente
 * **/
if (isset( $_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip  = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$ip = explode(',', str_replace(' ', '', $ip))[0];
/** Fin Explicación 1 **/

/** Inicio Explicación 2 **/
/**
* Fragmento de codigo que guarda los datos geograficos del cliente para no reconsultarlos
* cada que carge la pagina.
 * La consulta de los datos geograficos se hace por medio de una api https://ipdata.co/
 * donde se tendra que registrar y obtener tu nueva key y cambiarla en $keyApi
*  */
$keyApi = '670ffe7a0bd967e949ee51ff856a24a4812fe48f9efe99140e1ce4fd';

/**
 * Fallback para cuando la API de ipdata falla o da timeout.
 * Usa el header de Cloudflare si está disponible para al menos conocer el país.
 * Evita que una caída de la API externa tumbe todas las páginas del sitio.
 */
function lookupIpdataSafe($ip, $keyApi) {
    try {
        $httpClient = new Psr18Client();
        $psr17Factory = new Psr17Factory();
        $ipdata = new Ipdata($keyApi, $httpClient, $psr17Factory);
        return $ipdata->lookup($ip);
    } catch (\Throwable $e) {
        error_log('ipdata lookup failed: ' . $e->getMessage());
        $cf = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? trim($_SERVER['HTTP_CF_IPCOUNTRY']) : '';
        $country = ($cf && $cf !== 'XX' && $cf !== 'T1') ? $cf : 'AR';
        return [
            'country_code' => $country,
            'currency' => [
                'code' => $country === 'AR' ? 'ARS' : 'USD',
                'symbol' => '$',
            ],
        ];
    }
}

if(isset($productoIP) && $productoIP != null){
    $dataIP = getIP($ip, $productoIP);
    if ($dataIP == null) {
        $data = lookupIpdataSafe($ip, $keyApi);

        insertIP($ip, $productoIP, json_encode($data), json_encode($_COOKIE));
    } else {
        $data = json_decode($dataIP['data'], true);
        updateIP($ip, $productoIP, $dataIP['visitas'] + 1, json_encode($_COOKIE));
    }
} else {
    $dataC =  isset($idcurso) ? $idcurso : (isset($_GET['curso']) ? $_GET['curso'] : null);
    if($dataC == null){
        $data = lookupIpdataSafe($ip, $keyApi);
    } else {
        $dataIP = getIP($ip, $dataC) ;
        if ($dataIP == null) {
            $data = lookupIpdataSafe($ip, $keyApi);

            insertIP($ip, $dataC, json_encode($data), json_encode($_COOKIE));
        } else {
            $data = json_decode($dataIP['data'], true);
            updateIP($ip, $dataC, $dataIP['visitas'] + 1, json_encode($_COOKIE));
        }
    }
}

if (!is_array($data)) {
    $data = ['country_code' => 'AR', 'currency' => ['code' => 'ARS', 'symbol' => '$']];
}
if (!isset($data['country_code'])) { $data['country_code'] = 'AR'; }
if (!isset($data['currency']) || !is_array($data['currency'])) {
    $data['currency'] = ['code' => 'ARS', 'symbol' => '$'];
}
/** Fin Explicación 2 **/

/** Inicio Explicación 3 **/
/**
 * La variable $data['country_code'] contiene el codigo del pais del visitante
 * en este fragmento de codigo es donde se deben realizar las redirecciones, por
 * ejemplo si el visitante no es de argentina lo redireciona a la pagina de latam como en
 * el fragmento de codigo de abajo
 * ***/
if($data['country_code'] != 'AR'){
    //Este datos solo es para que puedan hacer visitas sin redirecionar en automatico por ejemplo
    //aprende-excel.com?dev, si consultas cualquier pagina de este dominio agrdando dev al final de la url
    //No se realizara la dedirección
    if(!isset($_GET['dev'])){
        /*
        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $actual_link = str_replace("reparando.com.ar", "comunidadreparando.com", $actual_link);
        $actual_link = str_replace("reparando.org", "comunidadreparando.com", $actual_link);
        header("Location: $actual_link");
         * 
         */
    }
}

if (!isset($_GET['dev'])) {
    //echo $_SERVER['HTTP_HOST'];
    $dominio = str_replace("www.", "", $_SERVER['HTTP_HOST']);
    if(in_array($dominio, ['aprende-excel.com', 'aprendiendo-excel.online', 'aprendiendo-excel.com', 'excel-facil.online'])){
        /**
         * aprende-excel.com, aprendiendo-excel.online, aprendiendo-excel.com a -> excel-facil.com
         * **/
        $actual_link = "https://excel-facil.com$_SERVER[REQUEST_URI]";
        header("Location: $actual_link");
        die();
    }
}

/** Inicio Explicación 3 **/



/** Inicio Explicación 4 **/
/**
 * Son las variables obligatorias por default
 * ***/
$urlRoot = "index.php"; //Es el archivo raiz del sitio
/* Id abrebiado del curso dedault, este curso se visualiza si el usuario borra por accidente el para metro de la url del sitio web */
//OBLIGATORIO
$idCursoDefault = 'excel';

//OBLIGATORIOS
$moneda = $data['currency']['code'];
$simbolo = $data['currency']['symbol']; 
$country = $data['country_code'];

$curso = isset($_GET['curso']) ? $_GET['curso'] : $idCursoDefault;
/** Inicio Explicación 4 **/
