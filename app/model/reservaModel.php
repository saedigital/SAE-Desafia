<?php
require_once SITEDIR.'/app/database/connect.php';

class Reserva
{

  public static function insertReserva($req)
  {
    $data = date("Y-m-d H:i:s");

    try {
      $query = db::connect()->prepare("INSERT INTO reservas ( res_qtde, esp_id, res_nome, res_cpf, res_datacriacao)
                VALUES ( :res_qtde, :esp_id, :res_nome, :res_cpf, :res_datacriacao)");
      $query->bindParam(':res_qtde', $req['esp_qtde']);
      $query->bindParam(':esp_id', $req['esp_id']);
      $query->bindParam(':res_nome', $req['res_nome']);
      $query->bindParam(':res_cpf', $req['res_cpf']);
      $query->bindParam(':res_datacriacao', $data);
      $query->execute();

      return "Reserva inserida com sucesso!";
    } catch(PDOException $e) {
      return $e->getMessage();
    }
  }

  public static function allReserva($esp)
  {
    try {
      $query = db::connect()->prepare("select * from reservas where esp_id = :esp_id");
      $query->bindParam('esp_id', $esp);
      $query->execute();
      return $query->fetchAll();

    } catch(PDOException $e) {
      return $e->getMessage();
    }

  }

  public static function sumReserva($esp)
  {
    try {
      $query = db::connect()->prepare("select SUM(e.esp_valor) as sum from reservas r
                                      inner join espetaculos e on e.esp_id = r.esp_id
                                      where e.esp_status <> 0
                                      and r.esp_id = :esp_id");
      $query->bindParam('esp_id', $esp);
      $query->execute();
      return $query->fetch();

    } catch(PDOException $e) {
      return $e->getMessage();
    }

  }

  public static function getReserva($id)
  {
    try {
      $query = db::connect()->prepare("select * from reservas where res_id = :id");
      $query->bindParam('id', $id);
      $query->execute();
      return $query->fetchAll();
    } catch(PDOException $e) {
      return $e->getMessage();
    }
}

  public static function cancelarReserva($res)
  {
    try {
      if (count(self::getReserva($res)) > 0) {
        $query = db::connect()->prepare("delete from reservas where res_id = :res_id");
        $query->bindParam('res_id', $res);
        $query->execute();

        return "Reserva removida com sucesso";

      }else {
        return 'Registro não encontrado';
      }

    } catch(PDOException $e) {
      return $e->getMessage();
    }
  }


}

?>
