<?php
namespace Controller;

use System\Controller;

class Error extends Controller {

    public function __construct(){
        parent::__construct();
    }

    /**
     * Error 404
     * @return null
     */
    public function NotFound(){
        $this->view("Error/NotFound");
    }

}