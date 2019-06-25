<?php


include_once 'config.php';

include_once SITEDIR.'/app/controller/EspetaculoController.php';
include_once 'cabecalho.php';
$msg = false;
  $espetaculos = EspetaculoController::retornaEspetaculo();

if ($acao == 'excluir'){
  if($_GET['id']) {
    $msg = EspetaculoController::removeEspetaculo($_GET['id']);
  }
}



?>
  <div class="container">
    <?php
    if ($msg) {
    echo '<div class="teal lighten-2"> '.$msg.' </div>';
    }
    ?>
    <div class="row">
    <div class="row">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Espetáculo</th>
            <th>Lugares Ocupados</th>
            <th>Lugares Vagos</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($espetaculos as $espetaculo) {
          $lugares = EspetaculoController::assentosEspetaculo($espetaculo['esp_id']);
          $restantes = ($espetaculo['esp_assentos'] - $lugares['ocupados']);
          echo "</tr>";
          echo "<td>" .$espetaculo['esp_id']. "</td>";
          echo "<td>" .$espetaculo['esp_descricao']. "</td>";
          echo "<td>" .$lugares['ocupados']. "</td>";
          echo "<td>" . $restantes . "</td>";
          echo '<td> <a class="btn deep-green '. ($restantes <= 0 ? 'disabled' : '') .'" href="reserva.php?id='.$espetaculo['esp_id'].'">Reservar</a>
                     <a class="btn deep-green" href="espetaculo.php?id='.$espetaculo['esp_id'].'">Editar</a>
                     <a class="btn deep-green '. ($lugares['ocupados'] > 0 ? 'disabled' : '') .'" href="index.php?acao=excluir&id='.$espetaculo['esp_id'].'">Excluir</a></td>';
          echo "</tr>";
        }
         ?>
        </tbody>
      </table>
    </div>
    <div class="row">
      <a class="btn deep-green" href="espetaculo.php">Incluir</a>
    </div>
    </div>

  </div>

<?php
include_once 'rodape.php'
?>
