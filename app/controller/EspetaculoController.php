<?php
include_once SITEDIR.'/app/model/espetaculoModel.php';

class EspetaculoController
{

  public static function retornaEspetaculo ()
  {
    return Espetaculo::allEspetaculo();
  }

  public static function assentosEspetaculo ($id)
  {
    return Espetaculo::assentosEspetaculo($id);
  }

  public static function reservaEspetaculo ()
  {
    return Espetaculo::reservaEspetaculo();
  }

  public static function findEspetaculo ($id)
  {
    return Espetaculo::findEspetaculo($id);
  }

  public static function removeEspetaculo ($id)
  {
    return Espetaculo::removeEspetaculo($id);
  }

  public static function insertEspetaculo ($req)
  {
    if ($req['esp_descricao'] != '' && $req['esp_valor'] != '' && $req['esp_assento'] != '' && $req['esp_data'] != '' && $req['esp_status'] != '') {
      $req['esp_status'] == true ? $req['esp_status'] = 1 : $req['esp_status'] = 0;
      return Espetaculo::insertEspetaculo($req);
    }else{
      return 'Necessário preenchimento de todos os campos';
    }
  }

  public static function updateEspetaculo ($req)
  {
    if ($req['esp_descricao'] != '' && $req['esp_valor'] != '' && $req['esp_assento'] != '' && $req['esp_data'] != '' && $req['esp_status'] != '') {
      $req['esp_status'] == true ? $req['esp_status'] = 1 : $req['esp_status'] = 0;
      return Espetaculo::updateEspetaculo($req);
    }else{
      return 'Necessário preenchimento de todos os campos';
    }
  }

}
?>
