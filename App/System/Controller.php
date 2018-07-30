<?php
namespace System;

use System\Libraries\Lang as Lang;
use System\Libraries\Session as Session;
use System\Libraries\Smarty as Smarty;

class Controller {

    private $hasEngine = null;
    private $smarty = null;
    private $lang = null;

    /**
     * Controller constructor.
     */
    public function __construct(){
        $this->hasEngine = FastApp::getInstance()->getConfig("template");
        if ($this->hasEngine == TEMPLATE_ENGINE_SMARTY) {
            $this->smarty = new Smarty();
        }

        $this->lang = new Lang();
        $this->lang->load("System");
    }

    /**
     * @return null|FastApp Get app instance
     */
    public function getApp(){
        return FastApp::getInstance();
    }

    /**
     * @return null|Session get session instance system Librarie
     */
    public function getSession(){
        return Session::getInstance();
    }

    /**
     * Set Content-Type of header
     * @param $type string Type of Response
     */
    public function setResponseType($type){
        Response::getInstance()->setHeaderType($type);
    }

    /**
     * @param $file string Name of Helper File
     */
    public function loadHelper($file){
        FastApp::getInstance()->loadHelper($file);
    }

    /**
     * @param $file string nome do view
     * @param array $data parametros pro view
     * @param bool $return bool true para retornar o HTML
     */
    public function view($file, $data = array(), $return = false){
        if ($this->hasEngine == TEMPLATE_ENGINE_SMARTY) {
            $this->smarty->view($file.".tpl", $data, $return);
        }
    }
}