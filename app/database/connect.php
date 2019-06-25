<?php

class db {

  public static $conexao;

  public static function connect ()
  {
      self::$conexao = new PDO('sqlite:'.SITEDIR.'/app/database/sae.sqlite');

      return self::$conexao;
  }

  public static function consulta($query){
      $resultado = $db->query($query);
      if(!$resultado)
      {
          die("Problemas na consulta: <br>".$query);
      }
      return $resultado;
  }
}
?>
