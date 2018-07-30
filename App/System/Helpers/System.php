<?php
if (!function_exists('redirect')){
    function redirect($uri = '', $method = 'auto', $code = NULL){
        if ( ! preg_match('#^(\w+:)?//#i', $uri)) {
            $uri = base_url($uri);
        }
        if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE){
            $method = 'refresh';
        }elseif ($method !== 'refresh' && (empty($code) OR ! is_numeric($code))){
            if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1'){
                $code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
                    ? 303
                    : 307;
            }else{
                $code = 302;
            }
        }
        switch ($method) {
            case 'refresh':
                header('Refresh:0;url='.$uri);
                break;
            default:
                header('Location: '.$uri, TRUE, $code);
                break;
        }
        exit;
    }
}

if (!function_exists("_uri_string")) {
    function _uri_string($uri){
        global $Config;
        if ($Config['enable_query_strings'] === FALSE) {
            is_array($uri) && $uri = implode('/', $uri);
            return ltrim($uri, '/');
        } elseif (is_array($uri)) {
            return http_build_query($uri);
        }
        return $uri;
    }
}

if (!function_exists("base_url")) {
    function base_url($uri = '', $protocol = NULL){
        $base_url = slash_item('base_url');
        if (isset($protocol)) {
            if ($protocol === '') {
                $base_url = substr($base_url, strpos($base_url, '//'));
            } else {
                $base_url = $protocol . substr($base_url, strpos($base_url, '://'));
            }
        }
        return $base_url._uri_string($uri);
    }
}

if (!function_exists("slash_item")) {
    function slash_item($item){
        global $Config;
        if (!isset($Config[$item])){
            return NULL;
        }elseif (trim($Config[$item]) === ''){
            return '';
        }
        return rtrim($Config[$item], '/').'/';
    }
}

if (!function_exists("ramdomCode")) {
    function ramdomCode($tamanho = 8) {
        $retorno = '';
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand-1];
        }
        return $retorno;
    }
}

if (!function_exists("dateToTime")) {
    function dateToTime($date, $format = "YYYY-MM-DD"){
        switch ($format) {
            case 'YYYY/MM/DD':
            case 'YYYY-MM-DD':
                list($y, $m, $d) = preg_split('/[-\.\/ ]/', $date);
                break;
            case 'YYYY/DD/MM':
            case 'YYYY-DD-MM':
                list($y, $d, $m) = preg_split('/[-\.\/ ]/', $date);
                break;
            case 'DD-MM-YYYY':
            case 'DD/MM/YYYY':
                list($d, $m, $y) = preg_split('/[-\.\/ ]/', $date);
                break;

            case 'MM-DD-YYYY':
            case 'MM/DD/YYYY':
                list($m, $d, $y) = preg_split('/[-\.\/ ]/', $date);
                break;

            case 'YYYYMMDD':
                $y = substr($date, 0, 4);
                $m = substr($date, 4, 2);
                $d = substr($date, 6, 2);
                break;

            case 'YYYYDDMM':
                $y = substr($date, 0, 4);
                $d = substr($date, 4, 2);
                $m = substr($date, 6, 2);
                break;
            default:
                return false;
        }
        return mktime(0, 0, 0, $m, $d, $y);
    }
}