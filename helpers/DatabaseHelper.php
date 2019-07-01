
<?php
class DatabaseHelper{

  private $connection;
  private $sql;
  private $data;

  public function __construct(){
    $this->connect();
  }

  private function connect(){
    $this->connection = mysqli_connect($_ENV['DATABASE_HOST'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
    if ($this->connection) {
      mysqli_select_db($this->connection, $_ENV['DATABASE_NAME']);
    }else{
      die('Não foi possível conectar: ' . mysqli_error());
    }
  }

  public function run(){
    try {
      $data = mysqli_query($this->connection, $this->sql);
      if($data){
        $this->data = $data;
        return mysqli_affected_rows($this->connection);
      }else{
        throw new Exception('Problema ao rodar a query:\n' . $this->sql);
      }
    } catch (\Throwable $th) {
      echo 'Ops, parece que encontramos uma dificuldade: ',  $th->getMessage(), "\n";
      exit;
    }    
  }

  public function setSql($sql){
    $this->sql = $sql;
  }

  public function getData(){
    return $this->data;
  }

  public function encerrar(){
    mysqli_close($this->connection);
  }
}