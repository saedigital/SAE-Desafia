<?php
spl_autoload_register(function($class) {

    $isApp = strstr($class, '\\', true) === 'App';
    if(!$isApp)
        return;

    $root = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app') . DIRECTORY_SEPARATOR;
    $path = $root . str_replace('\\', DIRECTORY_SEPARATOR , substr($class, 4)) . '.php';

    if(!file_exists($path))
        throw new \Exception("Class $class can't be found.");

    require $path;
    if(!class_exists($class))
        throw new \Exception("Class $class can't be found.");


});