<?php

namespace Application\Core;
use League\Plates;

class View
{
    public $templates;
    
    public function __construct()
    {
        $this->templates = new \League\Plates\Engine();
        $this->templates->addFolder('Templates',__DIR__ . "/../../Templates");
    }
    
    public function getTemplate($template,$data)
    {
        return $this->templates->render($template,$data);
    }    
}