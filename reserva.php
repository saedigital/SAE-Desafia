<?php
include_once 'cabecalho.php';

include_once SITEDIR.'/app/controller/EspetaculoController.php';
include_once SITEDIR.'/app/controller/ReservaController.php';
$msg = false;

if ($acao == 'inicio'){
  if (!empty($_POST)){
    $msg = ReservaController::insertReserva($_POST);
    $id = $_POST['id'];
  } else {
    $id = $_GET['id'];
  }
  $espetaculo = EspetaculoController::findEspetaculo($id);
?>
<div class="container">
<br>
<?php
if ($msg) {
echo '<div class="teal lighten-2"> '.$msg.' </div>';
}
?>
<div class="row">
  <form class="col s8" action="reserva.php" method="post">
    <div class="row">
      <div class="input-field col s3">
        <?php echo '<input type="text" name="esp_id" value="'.$id.'" readonly="readonly">'; ?>
        <label for="esp_id">Espetáculo</label>
      </div>
      <div class="input-field col s3">
        <?php echo '<input type="text" name="esp_valor" value="'.$espetaculo['esp_valor'].'" readonly="readonly">'; ?>
        <label for="esp_valor">Valor</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <label for="res_nome">Nome da reserva</label><br>
        <input type="text" name="res_nome" required>
      </div>
      <div class="input-field col s4">
        <label for="res_cpf">CPF</label><br>
        <input type="text" name="res_cpf" required>
      </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
        <label for="esp_qtde">Selecione a quantidade de assentos</label><br>
        <input type="number" name="esp_qtde" required>
        </div>
    </div>
    <input type="hidden" name="id" value="<?=$id?>">
        <button class="btn deep-orange">Salvar</button>
    </div>
      </form>
</div>


<?php
} else if ($acao == 'list'){
  if (!empty($_GET['id'])) {
    $msg = ReservaController::cancelarReserva($_GET['id']);
  }
  $espetaculos = EspetaculoController::reservaEspetaculo();
?>
<div class="container">
  <?php
  if ($msg) {
  echo '<div class="teal lighten-2"> '.$msg.' </div>';
  }
  ?>
  <div class="row">
  <div class="row">

    <?php
    foreach($espetaculos as $espetaculo) {
      echo "<h4>".$espetaculo['esp_descricao']."</h4>";
      echo "
            <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>CPF</th>
                  <th>Quantidade</th>
                  <th>Ação</th>
                </tr>
              </thead>
              <tbody> ";
      $reservas = ReservaController::allReserva($espetaculo['esp_id']);
      foreach ($reservas as $reserva) {
              echo "</tr>";
              echo "<td>" .$reserva['res_id']. "</td>";
              echo "<td>" .$reserva['res_nome']. "</td>";
              echo "<td>" .$reserva['res_cpf']. "</td>";
              echo "<td>" .$reserva['res_qtde']. "</td>";
              echo '<td> <a class="btn deep-green" href="reserva.php?acao=list&id='.$reserva['res_id'].'">Cancelar Reserva</a></td>';
              echo "</tr>";
      }
      echo '</tbody>
      <tfoot>
        <tr>
        <td colspan = 3 style="text-align:right"> <b>Valor total</b> </td>
        <td> <b>';
          $sum = ReservaController::sumReserva($espetaculo['esp_id']);
          echo $sum['sum'] .'</b></td>
        </tr>
              </table>';
    }
       ?>
  </div>
  </div>
</div>
<?php }
include_once 'rodape.php';
?>
