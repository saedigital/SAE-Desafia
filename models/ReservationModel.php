<?php
class ReservationModel{
  private $db;
  public function __construct(){
    require_once('helpers/DatabaseHelper.php');
    $this->db = new DatabaseHelper();
  }

  public static function getArrecadacaoTotal(){
    require_once('helpers/DatabaseHelper.php');
    $db = new DatabaseHelper();
    $sql = "SELECT count(id) * ".$_ENV['SEAT_PRICE']." as total FROM reservation";
    $db->setSql($sql);
    if($db->run()){
      $retorno = mysqli_fetch_assoc($db->getData());
      return $retorno['total'];
    }
  }

  public function getReservations($position = NULL, $spectacle = NULL){
    $sql = "SELECT * FROM reservation";
    if($position || $spectacle){
      $sql .= " WHERE"; 
      $operador = '';     
      if($position){
        $sql .= " position = ". $position;
        $operador = ' AND';
      }      
      if($spectacle){
        $sql .= $operador ." spectacle = ". $spectacle;
      } 
    }

    $this->db->setSql($sql);

    if($this->db->run()){
      if($position){
        return mysqli_fetch_assoc($this->db->getData());
      }else{
        return $this->db->getData();
      }
    }

  }
  
  public function updateData($id = NULL, $position = NULL, $spectacle = NULL){
    $sql = "UPDATE reservation SET position = '".$position."', spectacle = '".$spectacle."'";
    if($id){
      $sql .= " WHERE id = ". $id;
    }

    $this->db->setSql($sql);

    if($this->db->run()){
      return true;
    }else{
      return false;
    }

  }

  public function insertData($position = NULL, $spectacle = NULL){
    $sql = "INSERT INTO reservation (position, spectacle) VALUES('".$position."', '".$spectacle."')";

    $this->db->setSql($sql);

    if($this->db->run()){
      return true;
    }else{
      return false;
    }

  }

  public function delete($position, $spectacle = NULL){
    $sql = "DELETE FROM reservation WHERE position = ".$position." AND spectacle = ".$spectacle;

    $this->db->setSql($sql);

    if($this->db->run()){
      return true;
    }else{
      return false;
    }

  }
}