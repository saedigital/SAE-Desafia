<?php
namespace System;

class FastApp {
    protected static $instance;

    protected $Config;
    protected $Routes;
    protected $RoutesDynamic;
    protected $Patch;
    protected $Default;

    public static function getInstance(){
        return self::$instance;
    }

    public function __construct(){
        global $Config, $Routes, $DynamicRoutes;
        self::$instance = $this;

        $this->loadHelper("System");

        //ROUTES
        $this->Routes = $Routes;
        $this->RoutesDynamic = $DynamicRoutes;

        //CONFIGS
        $this->Config = $Config;
        if ($this->Config['db_activedb']){
            $this->initDatabase();
        }

        //CONTROLLER & METHODS
        $this->Default = str_replace([ $Config['base_dir'], $_SERVER['QUERY_STRING'], "?"],"",$_SERVER['REQUEST_URI']);

        $RequestURI = $this->Default;
        $this->rePatch($RequestURI);
        if (empty($this->Patch[0])) {
            $RequestURI = $Config['default_route'];
        }

        $checkController = false;
        if (isset($this->Routes[$RequestURI])){
            if (is_array($this->Routes[$RequestURI]) && isset($this->Routes[$RequestURI]['Controller']) && isset($this->Routes[$RequestURI]['Method'])){
                $checkController = true;
            }else{
                $RequestURI = $Config['default_route'];
            }
        }else{
            foreach ($this->RoutesDynamic as $route => $args){
                $key = str_replace([':any', ':num'], ['[^/]+', '[0-9]+'], $route);
                if (preg_match('#^'.$key.'$#', $RequestURI, $matches)){
                    $this->Routes[$matches[0]] = $args;
                    $checkController = true;
                    break;
                }
            }
        }

        if (!$checkController) {
            $this->rePatch($RequestURI);
            $nController = "\\Controller\\" . $this->Patch[0];
            $initController = null;
            if (class_exists($nController)) {
                $initController = new $nController();
            }else{
                redirect($Config['route_error_404']);
            }
            if (isset($this->Patch[1])) {
                $nMethod = $this->Patch[1];
                if (method_exists($initController, $nMethod)) {
                    $initController->$nMethod();
                }else{
                    redirect($Config['route_error_404']);
                }
            }else{
                redirect($Config['route_error_404']);
            }
        }else{
            $nController = $this->Routes[$RequestURI]['Controller'];
            $nMethod = $this->Routes[$RequestURI]['Method'];

            if (isset($this->Routes[$RequestURI]['Type']) && $this->Routes[$RequestURI]['Type'] !== Response::ALL && $_SERVER['REQUEST_METHOD'] !== $this->Routes[$RequestURI]['Type']){
                redirect($Config['route_error_404']);
            }

            if (isset($this->Routes[$RequestURI]['Headers']) && is_array($this->Routes[$RequestURI]['Headers'])){
                foreach ($this->Routes[$RequestURI]['Headers'] as $header){
                    Response::getInstance()->setHeader($header);
                }
            }
            if (isset($this->Routes[$RequestURI]['RequireHeader']) && is_array($this->Routes[$RequestURI]['RequireHeader'])){
                foreach ($this->Routes[$RequestURI]['RequireHeader'] as $key=>$header){
                    if (Response::getInstance()->getHeader($key) !== $header){
                        throw new \Exception("No have \"{$key}\" in request header");
                    }
                }
            }
            if (class_exists($nController)) {
                $initController = new $nController();
                if (method_exists($initController, $nMethod)) {
                    $initController->$nMethod();
                }else{
                    redirect($Config['route_error_404']);
                }
            }else{
                redirect($Config['route_error_404']);
            }
        }

        //CLEAR URL
        if (isset($this->Routes[$this->Default])){
            $this->rePatch($this->Default);
        }
    }

    public function getPatch($key){
        return $this->Patch[$key];
    }

    public function getConfig($key){
        return $this->Config[$key];
    }

    public function rePatch($Folder){
        $this->Patch = explode("/",$Folder);
    }

    public function initDatabase(){
        $database = new \stdClass();
        $database->hostname = $this->Config['db_hostname'];
        $database->database = $this->Config['db_database'];
        $database->username = $this->Config['db_username'];
        $database->password = $this->Config['db_password'];

        $database->generate = $this->Config['db_generate'];
        $database->generate_dir = BASE_PATH.'Models/'.$this->Config['db_generate_dir'];
        $database->generate_base = $this->Config['db_generate_base_only'];

        \MaikDatabase\Settings::getInstance()->createConnection($database, true, $this->Config['db_keyname']);
    }

    public function loadHelper($file){
        if (file_exists(BASE_PATH."Helpers/".$file.".php")) {
            require(BASE_PATH . "Helpers/" . $file . ".php");
        }else if (file_exists(BASE_PATH."System/Helpers/".$file.".php")){
            require(BASE_PATH."System/Helpers/".$file.".php");
        }else{
            new \Exception("File Helper {$file} not found");
        }
    }
}