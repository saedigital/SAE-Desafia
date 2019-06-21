<?php
require_once("src/DB.php");
require_once("Reserva.php");

class Espetaculo{
  public $id;

  public $nome;
  public $preco;
  public $numeroAssentos;

  public $reservas = [];

  public function getReservas(){
    if ($this->id == null){
      return [];
    }

    return Reserva::getWhereEspetaculoIDIs($this->id);
  }

  public function save(){
    if ($this->id !== null){
      $this->update();
    }else{
      $this->insertNew();
    }
  }

  public function isAssentoOcupado(int $numeroAssento){
    $reservas = $this->getReservas();
    
    foreach($reservas as &$reserva){
      if ($reserva->numeroAssento === $numeroAssento){
        return true;
      }
    }

    return false;
  }

  public function insertNew(){
    $preparedStatement = DB::getConnection()->prepare('INSERT INTO Espetaculos (nome, preco, numeroassentos) VALUES (?, ?, ?)');
    $preparedStatement->bindParam(1, $this->nome);
    $preparedStatement->bindParam(2, $this->preco);
    $preparedStatement->bindParam(3, $this->numeroAssentos);

    $preparedStatement->execute();
  }

  public function update(){
    if (!$this->id){
      return;
    }

    $preparedStatement = DB::getConnection()->prepare('UPDATE Espetaculos SET nome=?, preco=?, numeroassentos=? WHERE id=?');
    $preparedStatement->bindParam(1, $this->nome);
    $preparedStatement->bindParam(2, $this->preco);
    $preparedStatement->bindParam(3, $this->numeroAssentos);
    $preparedStatement->bindParam(4, $this->id);

    $preparedStatement->execute();
  }

  public function delete(){
    if (!$this->id){
      return;
    }

    Reserva::deleteAllFromEspetaculo($this->id);
    
    $statement = DB::getConnection()->prepare('DELETE FROM Espetaculos WHERE ID = ?');
    $statement->bindParam(1, $this->id);

    $statement->execute();
  }

  public static function fromAssociativeArray(array $array): Espetaculo{
    $espetaculo = new Espetaculo();

    $espetaculo->id = $array['id'];
    $espetaculo->nome = $array['nome'];
    $espetaculo->preco = $array['preco'];
    $espetaculo->numeroAssentos = $array['numeroassentos'];

    return $espetaculo;
  }

  public static function getByID(int $id) {
    $preparedStatement = DB::getConnection()->prepare('SELECT * FROM Espetaculos WHERE id=?');
    $preparedStatement->bindParam(1, $id);

    $preparedStatement->execute();

    $result = $preparedStatement->fetch(PDO::FETCH_ASSOC);

    if (!$result){
      return null;
    }else{
      return Espetaculo::fromAssociativeArray($result);
    }
  }

  public static function getAll(){
    $preparedStatement = DB::getConnection()->prepare('SELECT * FROM Espetaculos;');
    $preparedStatement->execute();
    $dbRows = $preparedStatement->fetchAll();
    $result = [];

    foreach($dbRows as $row){
      $result[] = Espetaculo::fromAssociativeArray($row);
    }

    return $result;
  }

  
}