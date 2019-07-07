<?php
/**
 * Created by PhpStorm.
 * User: PauloVital
 * Date: 06/07/2019
 * Time: 09:55
 */

namespace Vital\Configuration;


class Route
{
    private static $URI;
    private static $PARAMS;
    private static $PARAMS_URI;

    public function __construct()
    {
        // echo 'Roteador iniciado'.PHP_EOL;
    }

    public function autoload()
    {
        self::$URI = $_SERVER['REQUEST_URI'];
        self::$PARAMS = explode('?', self::$URI);
        self::$PARAMS_URI = (isset(self::$PARAMS[1])) ? self::$PARAMS[1] : '';
        if (empty(self::$PARAMS = rtrim(self::$PARAMS[0], '/'))) {
            self::$PARAMS = '/';
        }

        $routes = [
            '/' => ['Vital\\Controller\\Main', 'principal'],

            '/cad-show' => ['Vital\\Controller\\Show', 'cad_show'],
            '/save-espetaculo' => ['Vital\\Controller\\Show', 'save_show'],
            '/rel-show' => ['Vital\\Controller\\Show', 'rel_show'],
            '/excluir-espetaculo' => ['Vital\\Controller\\Show', 'delete_show'],
            '/atualizar-espetaculo' => ['Vital\\Controller\\Show', 'atualiza_show'],
            '/save-atu-espetaculo' => ['Vital\\Controller\\Show', 'update_show'],

            '/reservar-poltronas' => ['Vital\\Controller\\Armchair', 'armchair_show'],
            '/reserva' => ['Vital\\Controller\\Armchair', 'reserva'],
            '/libera' => ['Vital\\Controller\\Armchair', 'libera'],

            '/dashboard' => ['Vital\\Controller\\Dashboard', 'dashboard'],




        ];

        if (isset($routes[self::$PARAMS])) {
            $controller = $routes[self::$PARAMS][0];
            $function = $routes[self::$PARAMS][1];

            if (class_exists($controller)) {
                $classe = new $controller;
                call_user_func_array([$classe, $function], []);
            }

        } else {
            echo 'página não existe';
            // Criar página 404 ,400
        }
    }
}