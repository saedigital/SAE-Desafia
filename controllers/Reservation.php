<?php
class Reservation{
  public function __construct(){
    require_once('helpers/Geral.php');
  }

  public function index() {

    require_once('models/ReservationModel.php');
    $reservationModel = new ReservationModel();
    $reservations = $reservationModel->getReservations();

    $informacoes = array(
      'pagina' => 'main',
      'css' => array(
        'main.css'
      )
    );
    require_once('public/views/main.php');
  }

  public function register() {
    $informacoes = array(
      'pagina' => 'register',
      'css' => array(
        'register.css'
      )
    );

    $id = (isset($_GET['id'])) ? $_GET['id'] : NULL;
    if($id){//Edição
      require_once('models/ReservationModel.php');
      $reservationModel = new ReservationModel();
      $reservation = $reservationModel->getReservations($id);
    }
    require_once('public/views/reservationForm.php');
  }

  public function save() {
    $informacoes = array(
      'pagina' => 'message',
      'css' => array(
        'message.css'
      )
    );

    require_once('models/ReservationModel.php');
    $reservationModel = new ReservationModel();
    if($_POST['id']){//atualizar
      $resultado = $reservationModel->updateData($_POST['id'], $_POST['name'], $_POST['description']);
    }else{
      $resultado = $reservationModel->insertData($_POST['name'], $_POST['description']);
    }
    
    if($resultado){
      $message = "Tudo Salvo. Voce será redirecionado";
    }else{
      $message = "Um problema ocorreu. Voce será redirecionado";
    }
    header("refresh:3;url=".base_url());
    require_once('public/views/message.php');
  }

  public function delete() {
    $informacoes = array(
      'pagina' => 'message',
      'css' => array(
        'message.css'
      )
    );
    require_once('models/ReservationModel.php');
    $reservationModel = new ReservationModel();
    if($_GET['id']){//atualizar
      $resultado = $reservationModel->delete($_GET['id']);
    }
    if($resultado){
      $message = "Excluido";
    }else{
      $message = "Um problema ocorreu. Voce será redirecionado";
    }
    header("refresh:3;url=".base_url()."reservation");
    require_once('public/views/message.php');
  }
}