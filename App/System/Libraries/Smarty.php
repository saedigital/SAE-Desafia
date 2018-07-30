<?php
namespace System\Libraries;

use System\FastApp;

require_once( BASE_PATH_THIRD.'Smarty/Smarty.class.php' );

class Smarty extends \Smarty {

    public $debug = false;

    /**
     * Smarty constructor.
     */
    public function __construct(){
        parent::__construct();

        $this->template_dir = BASE_PATH . "Views/";
        $this->compile_dir = BASE_PATH_CACHE . "/Template";
        if (!is_writable($this->compile_dir)){
            @chmod( $this->compile_dir, 0777 );
        }
        $this->loadFilter('output', 'trimwhitespace');
    }

    /**
     * Set debug true or false
     * @param bool $debug
     */
    public function setDebug($debug = true){
        $this->debug = $debug;
    }

    /**
     * Load View
     * @param $template
     * @param array $data
     * @param bool $return
     * @return null|string
     */
    function view($template, $data = array(), $return = false){
        if (!$this->debug) {
            $this->error_reporting = false;
        }
        $this->error_unassigned = false;

        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }

        $this->assign("FastApp", FastApp::getInstance());
        $this->assign("Lang", Lang::getInstance());

        if ($return == false) {
            try {
                echo $this->fetch($template);
            }catch(\Exception $e){
                echo $e->getMessage();
            }
            return null;
        }else{
            try {
                return $this->fetch($template);
            }catch(\Exception $e){
                return $e->getMessage();
            }
        }
    }
}