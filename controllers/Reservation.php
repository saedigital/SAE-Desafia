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
      'pagina' => 'reservation',
      'css' => array(
        'reservation.css'
      )
    );
    require_once('public/views/reservation.php');
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
    if($_GET['position']){
      //Procurar pela reserva. Se existir, exclui, se não, a cria.
      require_once('models/ReservationModel.php');
      $reservationModel = new ReservationModel();
      $reservation = $reservationModel->getReservations($_GET['position'], $_GET['spectacle']);
      if(isset($reservation->num_rows) && $reservation->num_rows){
        //Excluir
        $resultado = $reservationModel->delete($_GET['id']);
        $message = "Reserva excluída. Voce será redirecionado";
      }else{
        //Criar
        $resultado = $reservationModel->insertData($_POST['name'], $_POST['description']);
        $message = "Reserva feita. Voce será redirecionado";
      }

      
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