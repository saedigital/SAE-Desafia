<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 14:45
 */

namespace App\Config;


class RouteCollection
{

    private static $collection = [];

    public static function scan() {
        /* @var $route Route */
        foreach (static::$collection as $route)
            if($route->checkAndRun())
                return true;
    }

    public static function set(string $expression, string $controller, string $method) {
        static::$collection[] = new Route($expression, $controller, $method);
    }


}