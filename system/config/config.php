<?php
class Config{
    private $database_host;
    private $database_user;
    private $database_name;
    private $database_password;
    private $site_url;
    private $main_controller;
    private $errors_routes = array('300'=>'', '301'=>'', '404'=>'', '500'=>'');
    private $application_routes = array();

    public function __construct(){
        $this->setErrorsDisplay();
    }

    public function setRotasPadroes($site_url, $main_controller){
        $this->site_url = $site_url;
        $this->main_controller = $main_controller;
    }

    public function setDataBaseConfig($host, $user, $password, $name){
        $this->database_host = $host;
        $this->database_user = $user;
        $this->database_password = $password;
        $this->database_name = $name;
    }

    public function setErrorsDisplay(){
        switch ($_ENV['ENVIRONMENT'])
        {
            case 'development':
                error_reporting(-1);
                ini_set('display_errors', 1);
            break;

            case 'testing':
                error_reporting(-1);
                ini_set('display_errors', 1);
                break;

            case 'production':
                ini_set('display_errors', 0);
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
            break;

            default:
                header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
                echo 'O environment da aplicação não está setado corretamente.';
                exit(1);
        }
    }

    public function getDataBaseConfig(){
        return $ar = array(
            'host' => $this->$database_host,
            'user' => $this->database_user,
            'senha' => $this->database_password,
            'name' => $this->database_name,
        );
    }

    public function getSiteUrl(){
        return $this->application_routes;
    }

    public function getControllerMain(){
        return $this->main_controller;
    }
}