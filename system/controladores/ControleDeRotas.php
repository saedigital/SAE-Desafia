<?php
class ControleDeRotas{

  private $config;

  public function __construct($config){
    $this->config = $config;
    $this->startControladoriaControllersUrl();
  }

  private function startControladoriaControllersUrl(){
    $broken_url = explode('/index.php/', $_SERVER['REQUEST_URI']);
    if(count($broken_url)==2){//Chamar controller
      $broken_parameters = explode('/', $broken_url[1]);
      if($broken_parameters[0]){
        try{
          if(file_exists('controllers/'.ucfirst($broken_parameters[0]).'.php')){
            require_once('controllers/'.ucfirst($broken_parameters[0]).'.php');
            $controller = new $broken_parameters[0]();
            if(isset($broken_parameters[1]) && $broken_parameters[1]){
              $method = explode('?', $broken_parameters[1]);
              $method = (string) $method[0];
              $controller->$method();
            }else{
              $controller->index();
            }
          }else{
            throw new Exception('Problema ao carregar controller: '.ucfirst($broken_parameters[0]));
          }
        }catch(Exception $e){
          echo 'Ops, parece que encontramos um problema: ',  $e->getMessage(), "\n";
        }
      }else{//Chama o padrão
        $this->callPattern();
      }
    }else{//Chama o padrão
      $this->callPattern();
    }
  }

  private function callPattern(){
    $main = (string) $this->config->getControllerMain();
    require_once('controllers/'.$main.'.php');
    $controller = new $main();
    $controller->index();
  }
}

