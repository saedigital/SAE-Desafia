<?php
/**
 * Created by PhpStorm.
 * User: PauloVital
 * Date: 06/07/2019
 * Time: 09:57
 */

namespace Vital\Controller;


class Main
{
    public function __construct()
    {
    //    echo 'Construct da Main'.PHP_EOL;
    }

    public function principal()
    {
        include_once "../App/Views/index.html";

    }
}