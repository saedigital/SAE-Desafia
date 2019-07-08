<?php

namespace App\Controllers;

class IndexController extends BaseController 
{
    public function indexAction()
    {
        $this->factory->get('events');
        $html = file_get_contents('home.html');
        return $html;
    }
}