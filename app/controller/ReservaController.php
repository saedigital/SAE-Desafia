<?php
include_once SITEDIR.'/app/model/reservaModel.php';

class ReservaController
{

  public static function insertReserva ($req)
  {
    if ($req['res_nome'] != '' && $req['res_cpf'] != '' && $req['esp_qtde'] != '' ) {
      return Reserva::insertReserva($req);
    }else{
      return 'Necessário preenchimento de todos os campos';
    }

  }

  public static function allReserva ($esp)
  {
    return Reserva::allReserva($esp);
  }

  public static function cancelarReserva ($res)
  {
    return Reserva::cancelarReserva($res);
  }

  public static function sumReserva ($esp)
  {
    return Reserva::sumReserva($esp);
  }
}
?>
