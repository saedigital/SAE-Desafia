<?php
class SpectacleModel{
  private $db;
  public function __construct(){
    require_once('helpers/DatabaseHelper.php');
    $this->db = new DatabaseHelper();
  }

  public function getSpectacles($id = NULL){
    $sql = "SELECT * FROM spectacle";
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
  
  public function updateData($id = NULL, $name = NULL, $description = NULL){
    $sql = "UPDATE spectacle SET name = '".$name."', description = '".$description."'";
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

  public function insertData($name = NULL, $description = NULL){
    $sql = "INSERT INTO spectacle (name, description) VALUES('".$name."', '".$description."')";

    $this->db->setSql($sql);

    if($this->db->run()){
      return true;
    }else{
      return false;
    }

  }

  public function delete($id){
    $sql = "DELETE FROM spectacle WHERE id = ".$id;

    $this->db->setSql($sql);

    if($this->db->run()){
      return true;
    }else{
      return false;
    }

  }
}