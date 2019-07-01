<?php
class Reservation{
  public function __construct(){
    require_once('helpers/Geral.php');
  }

  public function index() {

    require_once('models/ReservationModel.php');
    $reservationModel = new ReservationModel();
    $resultado = $reservationModel->getReservations(NULL, $_GET['spectacle']);
    if(count($resultado)){
      while($row = mysqli_fetch_array($resultado)) {
        $reservations[] = $row['position'];
      }
    }else{
      $reservations = array();
    }
      

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
    if(isset($_GET['position'])){

      //Procurar pela reserva. Se existir, exclui, se não, a cria.
      require_once('models/ReservationModel.php');
      $reservationModel = new ReservationModel();
      $reservation = $reservationModel->getReservations($_GET['position'], $_GET['spectacle']);
      
      if(count($reservation)){
        //Excluir
        $resultado = $reservationModel->delete($_GET['position'], $_GET['spectacle']);
        $message = "Reserva excluída. Voce será redirecionado";
      }else{
        //Criar
        $resultado = $reservationModel->insertData($_GET['position'], $_GET['spectacle']);
        $message = "Reserva feita. Voce será redirecionado";
      }
    }else{
      $message = "Problemas na aplicação. Voce será redirecionado";
    }
    
    header("refresh:3;url=".base_url().'reservation/index/?spectacle='.$_GET['spectacle']);
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