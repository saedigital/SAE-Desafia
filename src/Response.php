<?php
class Response{
  public static function send($data){
    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json');
    echo json_encode($data, JSON_NUMERIC_CHECK);
    // exit();?
  }

  public static function sendUnprocessableEntity(){
    header('HTTP/1.1 422 Unprocessable Entity');
    // exit();?
  }
}