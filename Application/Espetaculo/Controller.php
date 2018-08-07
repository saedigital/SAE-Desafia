<?php
namespace Application\Espetaculo;
use Application\Core;

class Controller extends \Application\Core\Controller
{
    public function index()
    {
      header("Location:/dashboard", 301);
    }

    public function add()
    {
      
      $request['titulo'] = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_MAGIC_QUOTES);
      $request['valor']  = filter_input(INPUT_POST, 'valor');
      
      //Formatação moeda de pt_br para iso
      $request['valor']  = explode(',',$request['valor']);
      $request['valor']  =  $request['valor'][0] ."." . $request['valor'][1];
      
      $model = new \Application\Espetaculo\Model();
      
      if( !$model->conexaoDbal()->insert('espetaculos', $request) ){
        $_SESSION['__alert']['context'] = 'danger';
        $_SESSION['__alert']['content'] = 'Não foi possível gravar este espetáculo!';
        
      }

      $_SESSION['__alert']['context'] = 'success';
      $_SESSION['__alert']['content'] = 'Espetáculo registrado com sucesso!';
    
      header("Location:/dashboard", 301);

    }
    
    public function update(){

      $where['id']       = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
      
      $request['titulo'] = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_MAGIC_QUOTES);
      $request['valor']  = filter_input(INPUT_POST, 'valor');
      
      //Formatação moeda de pt_br para iso
      $request['valor']  = explode(',',$request['valor']);
      $request['valor']  =  $request['valor'][0] ."." . $request['valor'][1];
      
      $model = new \Application\Espetaculo\Model();
      
      if( !$model->conexaoDbal()->update('espetaculos', $request, $where) ){
        $_SESSION['__alert']['context'] = 'danger';
        $_SESSION['__alert']['content'] = 'Não foi possível atualizado este espetáculo!';
        
      }

      $_SESSION['__alert']['context'] = 'success';
      $_SESSION['__alert']['content'] = 'Espetáculo atualizado com sucesso!';
    
      header("Location:/dashboard", 301);      

    }    
    
    public function delete($id){
            
      $request['id']  = (int)$id;
      
      $model = new \Application\Espetaculo\Model();

      if( !$model->conexaoDbal()->delete('espetaculos', $request) ){
        $_SESSION['__alert']['context'] = 'danger';
        $_SESSION['__alert']['content'] = 'Não foi possível deletar este espetáculo!';
        
      }

      $_SESSION['__alert']['context'] = 'success';
      $_SESSION['__alert']['content'] = 'Espetáculo deletado com sucesso!';
    
      header("Location:/dashboard", 301);

    }

}