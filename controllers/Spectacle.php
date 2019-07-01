<?php
class Spectacle{
  public function __construct(){
    require_once('helpers/Geral.php');
  }

  public function index() {

    require_once('models/SpectacleModel.php');
    $spectacleModel = new SpectacleModel();
    $spectacles = $spectacleModel->getSpectacles();

    $informacoes = array(
      'pagina' => 'main',
      'css' => array(
        'main.css'
      )
    );
    require_once('public/views/main.php');
  }

  public function register() {
    $informacoes = array(
      'pagina' => 'register',
      'css' => array(
        'register.css'
      )
    );

    $id = (isset($_GET['id'])) ? $_GET['id'] : NULL;
    if($id){//Edição
      require_once('models/SpectacleModel.php');
      $spectacleModel = new SpectacleModel();
      $spectacle = $spectacleModel->getSpectacles($id);
    }
    require_once('public/views/spectacleForm.php');
  }

  public function save() {
    $informacoes = array(
      'pagina' => 'message',
      'css' => array(
        'message.css'
      )
    );

    require_once('models/SpectacleModel.php');
    $spectacleModel = new SpectacleModel();
    if($_POST['id']){//atualizar
      $resultado = $spectacleModel->updateData($_POST['id'], $_POST['name'], $_POST['description']);
    }else{
      $resultado = $spectacleModel->insertData($_POST['name'], $_POST['description']);
    }
    
    if($resultado){
      $message = "Tudo Salvo. Voce será redirecionado";
    }else{
      $message = "Um problema ocorreu. Voce será redirecionado";
    }
    header("refresh:3;url=".base_url());
    require_once('public/views/message.php');
  }

  public function delete() {
    $informacoes = array(
      'pagina' => 'message',
      'css' => array(
        'message.css'
      )
    );
    require_once('models/SpectacleModel.php');
    $spectacleModel = new SpectacleModel();
    if($_GET['id']){//atualizar
      $resultado = $spectacleModel->delete($_GET['id']);
    }
    if($resultado){
      $message = "Excluido";
    }else{
      $message = "Um problema ocorreu. Voce será redirecionado";
    }
    header("refresh:3;url=".base_url()."spectacle");
    require_once('public/views/message.php');
  }
}