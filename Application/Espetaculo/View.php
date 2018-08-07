<?php

namespace Application\Espetaculo;
use Application\Core;

class View extends \Application\Core\View
{
    public function render($data)
    {
        echo $data;
    }
}