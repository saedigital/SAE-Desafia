<?php
require_once('src/Response.php');
require_once('src/Entities/Espetaculo.php');

class ControllerEspetaculos{

  public function bindRoutes(Router $router){
    $router->get("/api/espetaculos", 'ControllerEspetaculos::getEspetaculos');
    $router->get("/api/espetaculo", 'ControllerEspetaculos::getEspetaculo');
    $router->post("/api/espetaculo", 'ControllerEspetaculos::postEspetaculo');
    $router->delete("/api/espetaculo", 'ControllerEspetaculos::deleteEspetaculo');

    $router->post("/api/espetaculo/reservar", 'ControllerEspetaculos::postReservar');
    $router->delete("/api/espetaculo/reserva", 'ControllerEspetaculos::deleteReserva');
  }

  public static function getEspetaculos(){
    Response::send(Espetaculo::getAll());
  }

  public static function getEspetaculo(){
    $espetaculo = Espetaculo::getByID($_GET["id"]);

    if ($espetaculo == null){
      Response::sendUnprocessableEntity();
      return;
    }

    $reservas = $espetaculo->getReservas();

    // Remover nome e email das pessoas
    foreach($reservas as &$reserva){
      $reserva->nome = "";
      $reserva->email = "";
    }

    $espetaculo->reservas = $reservas;

    Response::send($espetaculo);
  }

  public static function postEspetaculo(){
    $data = json_decode(file_get_contents('php://input'), true);
    $espetaculo = null;

    if (array_key_exists('id', $data)){
      $espetaculo = Espetaculo::getByID($data['id']);

      if ($espetaculo == null){
        Response::sendUnprocessableEntity();
        return;
      }

      if (count($espetaculo->getReservas()) && $espetaculo->numeroAssentos != $data['numeroAssentos']){
        Response::sendUnprocessableEntity();
        return;
      }
    }else{
      $espetaculo = new Espetaculo();
    }

    $espetaculo->nome = $data['nome'];
    $espetaculo->numeroAssentos = $data['numeroAssentos'];
    $espetaculo->preco = 23.76;

    $espetaculo->save();

    Response::send("");
  }

  public static function deleteEspetaculo(){
    $data = json_decode(file_get_contents('php://input'), true);

    $espetaculo = Espetaculo::getByID($data['idEspetaculo']);

    if (!$espetaculo){
      Response::sendUnprocessableEntity();
      return;
    }

    $espetaculo->delete();

    Response::send("");
  }

  public static function postReservar(){
    $data = json_decode(file_get_contents('php://input'), true);

    $espetaculo = Espetaculo::getByID($data['idEspetaculo']);

    if ($espetaculo == null){
      Response::sendUnprocessableEntity();
      return;
    }

    if ($espetaculo->isAssentoOcupado($data['numeroAssento'])){
      Response::sendUnprocessableEntity();
      return;
    }

    $reserva = new Reserva();
    $reserva->nomePessoa = $data['nomePessoa'];
    $reserva->email = $data['email'];
    $reserva->numeroAssento = $data['numeroAssento'];
    $reserva->idEspetaculo = $data['idEspetaculo'];

    $reserva->saveNew();
  }

  public static function deleteReserva(){
    $data = json_decode(file_get_contents('php://input'), true);
    $espetaculo = Espetaculo::getByID($data['idEspetaculo']);

    if (!$espetaculo){
      Response::sendUnprocessableEntity();
      return;
    }

    $reserva = Reserva::getById($data['idReserva']);

    if (!$reserva){
      Response::sendUnprocessableEntity();
      return;
    }

    if ($reserva->idEspetaculo != $espetaculo->id){
      Response::sendUnprocessableEntity();
      return;
    }

    $reserva->delete();

    Response::send("");
  }


}