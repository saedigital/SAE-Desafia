<?php
class ReservationModel{
  private $db;
  public function __construct(){
    require_once('helpers/DatabaseHelper.php');
    $this->db = new DatabaseHelper();
  }

  public function getReservations($id = NULL){
    $sql = "SELECT * FROM reservation";
    if($id){
      $sql .= " WHERE id = ". $id;
    }

    $this->db->setSql($sql);

    if($this->db->run()){
      if($id){
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

  public function delete($id){
    $sql = "DELETE FROM reservation WHERE id = ".$id;

    $this->db->setSql($sql);

    if($this->db->run()){
      return true;
    }else{
      return false;
    }

  }
}