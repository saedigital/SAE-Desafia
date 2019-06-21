<?php
require_once("File.php");

class Router{
  private $getMap = array();
  private $postMap = array();
  private $deleteMap = array();

  public function get(string $path, callable $function) {
    $this->getMap[$path] = $function;
  }

  public function post(string $path, callable $function) {
    $this->postMap[$path] = $function;
  }

  public function delete(string $path, callable $function) {
    $this->deleteMap[$path] = $function;
  }

  public function handle(string $method, string $requestPath) {
    switch($method){
      case 'GET':
        if (!$this->tryResolve($this->getMap, $requestPath)){
          $toTry = [
            'public' . $requestPath,
            'public' . $requestPath . 'index.html'
          ];

          foreach($toTry as $path){
            if (file_exists($path) && is_file($path)){
              File::send($path);
              return;
            }
          }

          $this->send404();
        }
        break;

      case 'POST':
        if (!$this->tryResolve($this->postMap, $requestPath)){
          $this->send404();
        }
        break;

      case 'DELETE':
        if (!$this->tryResolve($this->deleteMap, $requestPath)){
          $this->send404();
        }
        break;

      default:
        $this->send404();   
    }
  }

  private function tryResolve(array $map, string $path){
    if (array_key_exists($path, $map)){
      call_user_func($map[$path]);
      return true;
    }
    
    return false;
  }

  private function send404(){
    header('HTTP/1.0 404 Not Found');
  }
}