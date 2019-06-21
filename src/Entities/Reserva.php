<?php
require_once("src/DB.php");

class Reserva{
  public $id;
  public $nomePessoa;
  public $email;
  public $numeroAssento;
  
  public $idEspetaculo;

  public function saveNew(){
    $statement = DB::getConnection()->prepare('INSERT INTO reservas (nomePessoa, email, numeroAssento, idEspetaculo) VALUES(?, ?, ?, ?)');
    $statement->bindParam(1, $this->nomePessoa);
    $statement->bindParam(2, $this->email);
    $statement->bindParam(3, $this->numeroAssento);

    $statement->bindParam(4, $this->idEspetaculo);

    $statement->execute();
  }

  public function delete(){
    if (!$this->id){
      return;
    }

    $statement = DB::getConnection()->prepare('DELETE FROM Reservas WHERE id = ?');
    $statement->bindParam(1, $this->id);

    $statement->execute();
  }


  public static function deleteAllFromEspetaculo(int $idEspetaculo){
    $statement = DB::getConnection()->prepare('DELETE FROM Reservas WHERE idEspetaculo = ?');
    $statement->bindParam(1, $idEspetaculo);

    $statement->execute();
  }


  public static function getByID(int $id){
    $statement = DB::getConnection()->prepare('SELECT * FROM Reservas WHERE id = ?');
    $statement->bindParam(1, $id);

    $statement->execute();

    if ($row = $statement->fetch()){
      return self::fromAssociativeArray($row);
    }else{
      return null;
    }
  }

  public static function fromAssociativeArray(array $array){
    $reserva = new Reserva();
    $reserva->id = $array['id'];

    $reserva->nomePessoa = $array['nomepessoa'];
    $reserva->email = $array['email'];
    $reserva->numeroAssento = $array['numeroassento'];

    $reserva->idEspetaculo = $array['idespetaculo'];

    return $reserva;
  }

  public static function getWhereEspetaculoIDIs(int $id){
    $statement = DB::getConnection()->prepare('SELECT * FROM Reservas WHERE idEspetaculo = ?');
    $statement->bindParam(1, $id);

    $statement->execute();

    $dbRows = $statement->fetchAll();
    $result = [];

    foreach($dbRows as $row){
      $result[] = self::fromAssociativeArray($row);
    }

    return $result;
  }


}