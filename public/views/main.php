<?php
require_once('template/header.php');
require_once('template/topo.php');
?>
  <section class="content">

    <div class="topo">
      <h1>Em Cartaz</h1> <a href="<?=base_url()?>spectacle/register" class="btn color"><span>+</span> Adicionar Espetáculo</a>
    </div>

    <p>Valor Total Arrecadado: R$ <?=number_format($valorTotalArrecadado, 2, ',', '.')?></p>
    <br>

    <div class="spectacles card-group">
    <?php
      if(isset($spectacles->num_rows) && $spectacles->num_rows){
        foreach($spectacles as $spectacle){
    ?>
          <div class="card shadow">
            <div class="card-image">
              <h2 class="card-title"><?=$spectacle['name']?></h2>
              <p class="card-description"><?=$spectacle['description']?></p>
            </div>
            <div class="opcoes">
              <a href="<?=base_url()?>spectacle/delete?id=<?=$spectacle['id']?>" class="btn">Excluir</a>
              <a href="<?=base_url()?>spectacle/register?id=<?=$spectacle['id']?>" class="btn">Editar</a>
              <a href="<?=base_url()?>reservation/index/?spectacle=<?=$spectacle['id']?>" class="btn color">Reservas</a>
            </div>
          </div>
    <?php
        }
      }else{
        print '<h2>Nenhum espetáculo por enquanto</h2>';
      }
    ?>

    </div>

  </section>

<?php
require_once('template/footer.php');
?>