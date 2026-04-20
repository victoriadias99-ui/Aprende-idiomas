<?php
// Soporte: acceso seguro al header de Cloudflare (Railway no es CF, header puede faltar)
$country_code = isset($_SERVER["HTTP_CF_IPCOUNTRY"]) ? trim($_SERVER["HTTP_CF_IPCOUNTRY"]) : '';

if (isset($_GET['test'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Autoload del SDK de ipdata (esta en /a-libraries/vendor, no /vendor)
require_once dirname(__DIR__) . '/a-libraries/vendor/autoload.php';

use Ipdata\ApiClient\Ipdata;
use Symfony\Component\HttpClient\Psr18Client;
use Nyholm\Psr7\Factory\Psr17Factory;

/**
 * Fallback seguro para cuando la API de ipdata falla o da timeout.
 * Usa el header Cloudflare como fallback, y ARS/AR por default si ninguno responde.
 */
function lookupIpdataSafe($ip) {
    try {
        $httpClient = new Psr18Client();
        $psr17Factory = new Psr17Factory();
        $ipdata = new Ipdata(Keys::$ipdataApi, $httpClient, $psr17Factory);
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
                'native' => '$',
            ],
        ];
    }
}

if (isset($country_code) && $country_code != '') {
    // Si Cloudflare nos dio el pais, no hace falta llamar ipdata
    $data = [
        'country_code' => $country_code,
        'currency' => [
            'code' => $country_code === 'AR' ? 'ARS' : 'USD',
            'symbol' => '$',
            'native' => '$',
        ],
    ];
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
        $dataIP = getIP($ip[0], $productoIP);
        if ($dataIP == null) {
            $data = lookupIpdataSafe($ip[0]);
            insertIP($ip[0], $productoIP, json_encode($data));
        } else {
            $data = json_decode($dataIP['data'], true);
            updateIP($ip[0], $productoIP, $dataIP['visitas'] + 1);
        }
    } else {
        $dataC = isset($curso) ? $curso : (isset($_GET['curso']) ? $_GET['curso'] : null);
        if ($dataC == null) {
            $data = lookupIpdataSafe($ip[0]);
        } else {
            $dataIP = getIP($ip[0], $dataC);
            if ($dataIP == null) {
                $data = lookupIpdataSafe($ip[0]);
                insertIP($ip[0], $dataC, json_encode($data));
            } else {
                $data = json_decode($dataIP['data'], true);
                updateIP($ip[0], $dataC, $dataIP['visitas'] + 1);
            }
        }
    }

    if (!is_array($data)) {
        $data = ['country_code' => 'AR', 'currency' => ['code' => 'ARS', 'symbol' => '$', 'native' => '$']];
    }

    if (isset($_GET['test'])) {
        $test = $_GET['test'];
    } else {
        $test = 0;
    }

    $urlRoot = "index.php";

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
        $moneda = $data['currency']['code'];
        $simbolo = isset($data['currency']['native']) ? $data['currency']['native'] : $data['currency']['symbol'];
        $country = $data['country_code'];
    }
}

// Defaults para cuando el flujo Cloudflare toma el ramo if de arriba
if (!isset($moneda)) {
    $moneda = isset($data['currency']['code']) ? $data['currency']['code'] : 'ARS';
}
if (!isset($simbolo)) {
    $simbolo = '$';
}
if (!isset($country)) {
    $country = isset($data['country_code']) ? $data['country_code'] : 'AR';
}
