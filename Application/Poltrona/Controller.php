<?php

namespace Application\Poltrona;
use Application\Core;

class Controller extends \Application\Core\Controller
{
  public function index()
  {
    header("Location:/dashboard", 301);
  }
  
  public function insertAjax($id, $poltrona)
  {        
    $request['espetaculo_id'] = (int)$id;
    $request['poltrona']      = filter_var($poltrona, FILTER_SANITIZE_MAGIC_QUOTES);

    $model = new \Application\Poltrona\Model();
    
    if( !$model->conexaoDbal()->insert('poltronas', $request) ){
      
      $return = ['danger','Não foi possível reservar esta poltrona!'];
      
    }

    $return = ['success','Poltrona reservada com sucesso!'];

    echo json_encode($return);

    return;

  }
  
  public function deleteAjax($id, $poltrona)
  {        
    $request['espetaculo_id'] = (int)$id;
    $request['poltrona']      = filter_var($poltrona, FILTER_SANITIZE_MAGIC_QUOTES);
    
    $model = new \Application\Poltrona\Model();

    if( !$model->conexaoDbal()->delete('poltronas', $request) ) {
      $return = ['danger','Não foi possível remover a reserva esta poltrona!'];
    }

    $return = ['success','Reserva removida com sucesso!'];

    echo json_encode($return);

    return;
  }

}