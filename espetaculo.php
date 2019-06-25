<?php
include_once 'cabecalho.php';

include_once SITEDIR.'/app/controller/EspetaculoController.php';
$msg = false;
$espetaculo = NULL;

if ($acao == 'inicio'){
  if (!empty($_POST)){
    if ($_POST['esp_id'] != 0 ) {
      $msg = EspetaculoController::updateEspetaculo($_POST);
      $espetaculo = EspetaculoController::findEspetaculo($_POST['esp_id']);
    } else {
      $msg = EspetaculoController::insertEspetaculo($_POST);
      $id = isset($_POST['id']);
    }
  } else {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $espetaculo = EspetaculoController::findEspetaculo($id);
    }
  }

?>
<div class="container">
<br>
<?php
if ($msg) {
echo '<div class="teal lighten-2"> '.$msg.' </div>';
}
?>
<div class="row">
  <form class="col s8" action="espetaculo.php<?php echo isset($espetaculo) ? "?id=".$espetaculo['esp_id'] : '' ?>" method="post">
    <div class="row">
      <div class="input-field col s4">
        <input type="text" name="esp_descricao" value="<?php echo isset($espetaculo) ? $espetaculo['esp_descricao'] : '' ?>">
        <label for="esp_descricao">Descrição</label>
      </div>
      <div class="input-field col s4">
        <input type="text" name="esp_assento" value="<?php echo isset($espetaculo) ? $espetaculo['esp_assentos'] : '' ?>">
        <label for="esp_assento">Qtde de assentos</label>
      </div>
      <div class="input-field col s4">
        <input type="text" name="esp_valor" value="<?php echo isset($espetaculo) ? $espetaculo['esp_valor'] : '' ?>">
        <label for="esp_valor">Valor do espetáculo</label>
      </div>
      <div class="input-field col s4">
        <input type="text" name="esp_data" value="<?php echo isset($espetaculo) ? $espetaculo['esp_data'] : '' ?>"
        <label for="esp_data">Data do Espetáculo</label>
      </div>
      <p>
      <label>
        <input name="esp_status" type="checkbox" <?php echo ($espetaculo['esp_status'] == 1 ? 'checked' : '') ?> />
        <span>Ativo</span>
      </label>
    </p>
    <input type="text" name="esp_id" value="<?php echo isset($espetaculo) ? $espetaculo['esp_id'] : '' ?>">
        <button class="btn deep-orange">Salvar</button>
    </div>
  </form>
</div>

<?php
}
include_once 'rodape.php'
?>
