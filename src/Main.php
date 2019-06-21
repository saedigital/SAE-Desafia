<?php
require_once('Env.php');
require_once('Router.php');
require_once('Controllers/ControllerEspetaculos.php');

loadEnv();

$router = new Router();
$controller = new ControllerEspetaculos();

$controller->bindRoutes($router);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->handle($method, $path);
