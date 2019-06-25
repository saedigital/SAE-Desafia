<?php
require_once SITEDIR.'/app/database/connect.php';

class Espetaculo
{

  public static function allEspetaculo()
  {

    $sql = "select * from espetaculos where esp_status <> 0 ";
    $query = db::connect()->query($sql);

    return $query->fetchAll();

  }

  public static function reservaEspetaculo()
  {

    $sql = "select * from espetaculos e
             where (select count(1) from reservas r where r.esp_id = e.esp_id) > 0
            and e.esp_status <> 0 ";
    $query = db::connect()->query($sql);

    return $query->fetchAll();

  }

  public static function removeEspetaculo($id)
  {
    try {
      if (count(self::findEspetaculo($id))) {
        $query = db::connect()->prepare("delete from espetaculos where esp_id = :esp_id");
        $query->bindParam('esp_id', $id);
        $query->execute();

        return "Espetaculo removido com sucesso";

      }else {
        return 'Registro não encontrado';
      }
    } catch(PDOException $e) {
    return $e->getMessage();
    }
  }

  public static function assentosEspetaculo($id)
  {

    $sql = "select sum(r.res_qtde) as ocupados, e.esp_assentos from reservas r
            inner join espetaculos e on e.esp_id = r.esp_id
            where e.esp_id = :esp_id";
    $query = db::connect()->prepare($sql);
    $query->bindParam(':esp_id', $id);
    $query->execute();

    return $query->fetch();

  }

  public static function findEspetaculo($id)
  {
    $sql = 'select * from espetaculos where esp_id = '.$id;
    $query = db::connect()->query($sql);
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  public static function insertEspetaculo($req)
  {
    $data = date("Y-m-d H:i:s");

    try {

      $query = db::connect()->prepare("INSERT INTO espetaculos ( esp_descricao, esp_assentos, esp_valor, esp_datacriacao, esp_data, esp_status)
                VALUES ( :esp_descricao, :esp_assentos, :esp_valor, :esp_datacriacao, :esp_data, :esp_status)");
      $query->bindParam(':esp_descricao', $req['esp_descricao']);
      $query->bindParam(':esp_assentos', $req['esp_assento']);
      $query->bindParam(':esp_valor', $req['esp_valor']);
      $query->bindParam(':esp_datacriacao', $data);
      $query->bindParam(':esp_data', $req['esp_data']);
      $query->bindParam(':esp_status', $req['esp_status']);
      $query->execute();

      return "Espetáculo inserido com sucesso!";
    } catch(PDOException $e) {
      return $e->getMessage();
    }
  }

  public static function updateEspetaculo($req)
  {
    $data = date("Y-m-d H:i:s");

    try {

      $query = db::connect()->prepare("UPDATE espetaculos SET   esp_descricao = :esp_descricao
                                                              , esp_assentos = :esp_assentos
                                                              , esp_valor = :esp_valor
                                                              , esp_dataalt = :esp_dataalt
                                                              , esp_data = :esp_data
                                                              , esp_status = :esp_status
                                                              WHERE esp_id = :esp_id
                                                              ");
      $query->bindParam(':esp_id', $req['esp_id']);
      $query->bindParam(':esp_descricao', $req['esp_descricao']);
      $query->bindParam(':esp_assentos', $req['esp_assento']);
      $query->bindParam(':esp_valor', $req['esp_valor']);
      $query->bindParam(':esp_dataalt', $data);
      $query->bindParam(':esp_data', $req['esp_data']);
      $query->bindParam(':esp_status', $req['esp_status']);
      $query->execute();

      return "Espetáculo alterado com sucesso!";
    } catch(PDOException $e) {
      return $e->getMessage();
    }
  }

}

?>
