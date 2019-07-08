<?php 
date_default_timezone_set('America/Sao_Paulo');

include __DIR__ . '/../vendor/autoload.php';

function methods($clazz) {
    echo '<pre>';
    $methods = get_class_methods(get_class($clazz));
    var_dump($methods);
};

function d($data) {
    echo '<pre>';
    var_dump($data);
    exit();
};

$parseUri = function () {
    $requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI');
    $partsUri = explode('/', $requestUri);
    array_shift($partsUri);
    $items = [];
    foreach ($partsUri as $key => $item) {
        $type = ($key == 0 || $key == 1) ? 'code' : 'arg';
        if ($type == 'code') {
            $item = !empty($item) ? $item : 'index';
        }
        $items[] = [
            'type'  => $type,
            'value' => $item,
        ];
    }

    return $items;
};

$controllerFilter = function ($parsUri) {
    $namespace      = '\\App\\Controllers\\';
    $controllerName = 'IndexController';
    $method         = 'indexAction';
    $parameters     = [];
    
    $numPars = count($parsUri);
    $controllerName = $namespace . $controllerName;
    if ($numPars > 0) {
        foreach ($parsUri as $key => $par) {        
            if ($key == 0 && $par['type'] == 'code') {
                $controllerName = $namespace . ucfirst($par['value']) . 'Controller';
            } else if ($key == 1 && $par['type'] == 'code') { 
                $method = $par['value'] . 'Action';
            } else {
                $indexParameters = count($parameters) + 1;
                $parameters['par_' . $indexParameters] = $par['value'];
            }
        }
    }

    if ( class_exists($controllerName) ) {
        $controller = new $controllerName();
        $controller->setFactory(new \App\Factory());
        $controller->setParameters($parameters);
        return $controller->{$method}();
    } else {
        header("HTTP/1.0 404 Not Found");
        $controllerName = $namespace . 'NotFoundController';
        $controller = new $controllerName();
        return $controller->indexAction();
    }
};

$app =  function() use($controllerFilter, $parseUri) {
    $parsUri    = $parseUri();
    $returnData = $controllerFilter($parsUri);
    
    if (is_array($returnData)) {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        printf(json_encode($returnData));
    } else {
        printf($returnData);
    }    
};

$app();