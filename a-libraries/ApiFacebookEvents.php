<?php
require_once dirname(__DIR__) . '/a-libraries/vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;

class ApiFacebookEventsFunciones {

    static function initPaymentSendDataInitPaymentFacebook($correo, $precio, $moneda, $url) {
        /*
        if (isset($_GET['test'])) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }

        $access_token = 'EAAOo6RhAAKABAGhPZCOqq3HDHPvMTKtRtOyAl6nVG5ZBnfI8ZAQBNFefiZCX9OO5UlxNvh6xa7RRQzjpmIOt96fQGxSSAxISgJttiLi0Sgoe6vwbpZAomF4etd7DusqgXZBpFTNSol7NRDtZC6idkZAMMYGh0lZCrM60AqgDTazhd26iTS992MP3luKRtUc7EghgZD';
        $pixel_id = '177917573796998';
        $test_id = 'none';//'TEST84181';


        if ($access_token != '' && $access_token != null) {
            Api::init(null, null, $access_token, false);
            $api = Api::instance();
            //$api->setLogger(new CurlLogger());

            $events = array();

            if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
                $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
            } else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $ip = explode(',', str_replace(' ', '', $ip))[0];

            $user_data = (new UserData())
                    ->setEmail(hash('sha256', $correo))
                    ->setClientIpAddress($ip)
                    ->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);

            if (isset($_COOKIE['_fbc']))
                $user_data->setFbc($_COOKIE['_fbc']);
            if (isset($_COOKIE['_fbp']))
                $user_data->setFbp($_COOKIE['_fbp']);
//
//        $custom_data = (new CustomData())
//                ->setValue($precio)
//                ->setCurrency($moneda);

            $event_0 = (new Event())
                    ->setEventName('InitiateCheckout')
                    ->setEventTime(time())
                    ->setEventSourceUrl($url)
                    ->setUserData($user_data);
            //->setCustomData($custom_data);

            array_push($events, $event_0);

            if ($test_id != 'none') {
                $request = (new EventRequest($pixel_id))
                        ->setEvents($events)
                        ->setTestEventCode($test_id);
            } else {
                $request = (new EventRequest($pixel_id))
                        ->setEvents($events);
            }
            $request->execute();
        }
        */
    }

    static function initPaymentSendDataDonePaymentFacebook($cache, $ipData, $correo, $precio, $moneda, $url) {
        /*
        if (isset($_GET['test'])) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }

        $access_token = 'EAAOo6RhAAKABAGhPZCOqq3HDHPvMTKtRtOyAl6nVG5ZBnfI8ZAQBNFefiZCX9OO5UlxNvh6xa7RRQzjpmIOt96fQGxSSAxISgJttiLi0Sgoe6vwbpZAomF4etd7DusqgXZBpFTNSol7NRDtZC6idkZAMMYGh0lZCrM60AqgDTazhd26iTS992MP3luKRtUc7EghgZD';
        $pixel_id = '177917573796998';
        $test_id = 'none';//'TEST84181';

        if ($access_token != '' && $access_token != null) {
            Api::init(null, null, $access_token, false);
            $api = Api::instance();
            //$api->setLogger(new CurlLogger());

            $events = array();

            $user_data = (new UserData())
                    ->setEmail(hash('sha256', $correo))
                    ->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);

            if ($ipData != null) {
                $user_data->setClientIpAddress($ipData->ip)
                        ->setZipCode($ipData->postal)
                        ->setCountryCode($ipData->country_code)
                        ->setCity($ipData->city);
            }


            if ($cache != null) {
                if (isset($cache->_fbc))
                    $user_data->setFbc($cache->_fbc);
                if (isset($cache->_fbp))
                    $user_data->setFbp($cache->_fbp);
            }

            $custom_data = (new CustomData())
                    ->setValue($precio)
                    ->setCurrency($moneda);

            $event_0 = (new Event())
                    ->setEventName('Purchase')
                    ->setEventTime(time())
                    ->setEventSourceUrl($url)
                    ->setUserData($user_data)
                    ->setCustomData($custom_data);

            array_push($events, $event_0);

            if ($test_id != 'none') {
                $request = (new EventRequest($pixel_id))
                        ->setEvents($events)
                        ->setTestEventCode($test_id);
            } else {
                $request = (new EventRequest($pixel_id))
                        ->setEvents($events);
            }
            $request->execute();
        }*/
    }

}

?>