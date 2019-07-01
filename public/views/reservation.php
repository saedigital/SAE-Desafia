<?php
require_once('template/header.php');
require_once('template/topo.php');
?>
  <section class="content">

    <div class="topo">
      <h1>Reservas</h1>
    </div>

    <p>Clique no assento que deseja reservar ou cancelar a reserva.</p>
    <br>
    <p>Arrecadação deste espetáculo até o momento: R$ <?=number_format(count($reservations) * $_ENV['SEAT_PRICE'], 2, ',', '.')?></p>
    <div class="legendas">
      <div class="legenda">
        <div class="quadrado"></div>
        <p><?=(100-(count($reservations))) ? 'Assentos Disponíveis: ' . (100-(count($reservations))) : 'Não há mais assentos disponíveis para este espetáculo.'?></p>
      </div>
      <div class="legenda">
        <div class="quadrado reservado"></div>
        <p><?=(count($reservations)) ? 'Assentos Ocupados: ' . (count($reservations)) : 'Não há reservas de assentos feitas para este espetáculo.'?></p>
      </div>
    </div>
    <br>

    <div class="seats">
        <div class="palco">PALCO</div>
    <?php    
        for($i = 1; $i <= 10; $i++){
            for($y = 1; $y <= 10; $y++){
              print '<a class="seat '.((in_array($i.$y, $reservations)) ? 'reservado' : '').'" href="'.base_url().'reservation/save/?position='.$i.$y.'&spectacle='.$_GET['spectacle'].'">'.$i.' - '.$y.'</a>';
            }
            print '<div class="clear"></div>';
        }
    ?>

    </div>

  </section>

<?php
require_once('template/footer.php');
?>