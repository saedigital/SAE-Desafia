<?php

session_start();

ini_set("display_errors", true);

require 'config.php';
require __DIR__ . '/vendor/autoload.php';

use Application\Dashboard;
use Application\Espetaculo;
use Application\Poltrona;


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $group) {    
    
    $group->addGroup('', function (FastRoute\RouteCollector $route) {
        $controller = 'Application\Dashboard\Controller';
        $route->addRoute('GET', '/',                   $controller);
        $route->addRoute('GET', '/dashboard',          $controller);
        $route->addRoute(['GET','POST'], '/dashboard/{method}', $controller);
    });
    
    $group->addGroup('/espetaculo', function (FastRoute\RouteCollector $route) {
        $controller = 'Application\Espetaculo\Controller';
        $route->addRoute('GET', '/',                             $controller);
        $route->addRoute(['GET','POST'], '/{method}',            $controller);
        $route->addRoute(['GET','POST'], '[/{method}/{id:\d+}]', $controller);
    }); 

    $group->addGroup('/poltrona', function (FastRoute\RouteCollector $route) {
        $controller = 'Application\Poltrona\Controller';
        $route->addRoute('GET', '/',                                    $controller);
        $route->addRoute(['GET','POST'], '/{method}',                   $controller);
        $route->addRoute(['GET','POST'], '[/{method}/{id:\d+}]',        $controller);
        $route->addRoute(['GET','POST'], '/{method}/{id:\d+}/{codigo}', $controller);
    });        

});

//--------------------

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {

    case FastRoute\Dispatcher::NOT_FOUND:
        header('HTTP/1.0 404 Not Found');
        die('404 Not Found');
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:        
        header('HTTP/1.0 405 Method Not Allowed');    
        die('405 Method Not Allowed');
        break;

    case FastRoute\Dispatcher::FOUND:
        
        $handler = $routeInfo[1];
        $vars    = $routeInfo[2];
                
        $method = @$vars['method'] ?: 'index';
        unset($vars['method']);
        
        call_user_func_array($handler . '::' . $method, $vars);

        break;

}