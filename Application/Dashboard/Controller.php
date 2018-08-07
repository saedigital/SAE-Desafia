<?php
namespace Application\Dashboard;
use Application\Core;

class Controller extends \Application\Core\Controller
{
    public function index()
    {            
      $modelEspetaculo = new \Application\Espetaculo\Model();
      $data['espetaculos'] = $modelEspetaculo->getAll();
      
      $modelPoltrona     = new \Application\Poltrona\Model();
      $data['poltronas'] =  $modelPoltrona->getOcupadas();      
      $data['poltronasJson'] = json_encode( ['poltronas' => $data['poltronas'] ], true);

      $view  = new \Application\Dashboard\View();
      $view->render($data);
    }

    public function refreshJson()
    {  
      $modelPoltrona         = new \Application\Poltrona\Model();
      $data['poltronas'] =  $modelPoltrona->getOcupadas();       
      
      echo json_encode( ['poltronas' => $data['poltronas'] ], true);
      
      return;    
    }
}