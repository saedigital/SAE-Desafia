<?php

namespace Application\Poltrona;
use Application\Core;

class View extends \Application\Core\View
{
    public function render($data)
    {
        echo $data;
    }
}