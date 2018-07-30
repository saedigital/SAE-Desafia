<?php
define("ROOT_PATH", __DIR__);
define("BASE_PATH", __DIR__."/App/");
define("BASE_PATH_CACHE", __DIR__."/App/Cache/");
define("BASE_PATH_THIRD", __DIR__."/App/Third/");
define("BASE_PATH_MODELS", __DIR__."/App/Models/");

define("TEMPLATE_ENGINE_NULL", null);
define("TEMPLATE_ENGINE_SMARTY","smarty");
define("TEMPLATE_ENGINE_TWIG","twig");

function loaderFastApp($class) {
    $filename = BASE_PATH . DIRECTORY_SEPARATOR . str_replace('\\', '/', $class) . '.php';
    if (file_exists($filename)) {
        require_once($filename);
    }else{
        $filename = BASE_PATH_THIRD . DIRECTORY_SEPARATOR . str_replace('\\', '/', $class) . '.php';
        if (file_exists($filename)) {
            require_once($filename);
        }
    }
}

spl_autoload_register('loaderFastApp');

require_once "App/Configs/Config.php";
require_once "App/Configs/Routes.php";
require_once "App/Configs/DinamycRoutes.php";