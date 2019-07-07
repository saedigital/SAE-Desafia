<?php

class Conn
{
    private $dns = "mysql:dbname=desafio_sae_bd; host=localhost";
    private $user = "root";
    private $pass = "";
    protected $conn;
    protected $campo;
    protected $parametro;
  //  protected $cp;
  //  protected $id;
 //   protected $value;
    protected $sql_insert;
    protected $sql_update;
    protected $sql_delete;
    protected $bindParam;

    public function __construct()
    {
        if(!$this->conn){
            try {
               $this->conn = new PDO($this->dns,$this->user, $this->pass);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

   public function consulta($table)
    {

        $stmt = $this->conn->prepare("SELECT * FROM $table ");
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function insert($table, $campos)
    {
        foreach($campos as $indice => $valor)
        {
            $this->campo .= $indice.', ';
            $this->parametro .= ':'.$indice.', ';
        }
        $this->campo = rtrim($this->campo, ', ') ;
        $this->parametro = rtrim($this->parametro, ', ') ;
        $this->sql_insert = "INSERT INTO ".$table." ($this->campo) VALUES ($this->parametro)";
        $stmt = $this->conn->prepare("$this->sql_insert");


        foreach($campos as $indice => $valor) {
            $stmt->bindValue($indice,$valor);
        }
        if($stmt->execute() === false){
            print_r($stmt->errorInfo());
        } else {
            var_dump($this->sql_insert);
        }
    }

    public function update($table, $campos)
    {
        foreach($campos as $indice => $valor)
        {
            if($indice == "ID"){
                $this->id = $indice.' = '.':'.$indice;
            } else {
                $this->cp .= $indice.' = '.':'.$indice.', ';
            }
        }

        $this->cp = rtrim($this->cp, ', ') ;
        $this->sql_update = "UPDATE $table SET ".$this->cp." WHERE ".$this->id;
        $stmt = $this->conn->prepare("$this->sql_update");
        foreach($campos as $indice => $valor) {
            $stmt->bindValue($indice,$valor);
        }
        if($stmt->execute() === false){
            print_r($stmt->errorInfo());
        } else {
            print_r('Atualizado com Sucesso');
        }
    }

    public function delete ($table, $id)
    {
        $this->sql_delete = "DELETE FROM $table WHERE ID = $id";
        $stmt = $this->conn->prepare("$this->sql_delete");
        if($stmt->execute() === false){
            print_r($stmt->errorInfo());
        } else {
            print_r('Excluido com Sucesso');
        }
    }
}
