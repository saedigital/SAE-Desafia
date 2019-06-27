<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 14:44
 */
namespace App\Config;

class Bootstrap
{

    public static function init($path) {
        define('ROOT_PATH', $path. DIRECTORY_SEPARATOR);
        define('PUBLIC_PATH', ROOT_PATH . 'public' . DIRECTORY_SEPARATOR);
        define('VIEW_PATH', ROOT_PATH . 'views' . DIRECTORY_SEPARATOR);
        define('APP_PATH', ROOT_PATH . 'app' . DIRECTORY_SEPARATOR);
        define('CONFIG_PATH', ROOT_PATH . 'config' . DIRECTORY_SEPARATOR);
        RouteCollection::scan();
    }

}