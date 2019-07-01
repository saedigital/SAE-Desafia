<?php
require_once('template/header.php');
require_once('template/topo.php');
?>
  <section class="content">

    <div class="topo">
      <h1>Reservas</h1>
    </div>

    <p>Clique no assento que deseja reservar ou excluir a reserva.</p>
    <br>

    <div class="seats">
        <div class="palco">PALCO</div>
    <?php
        for($i = 1; $i <= 10; $i++){
            for($y = 1; $y <= 10; $y++){
                print '<a class="seat" href="'.base_url().'reservation/save/?position'.$i.$y.'?spectacle'.$i.$y.'">'.$i.' - '.$y.'</a>';
            }
            print '<div class="clear"></div>';
        }
    ?>

    </div>

  </section>

<?php
require_once('template/footer.php');
?>