  <div class="main main-raised">
    <div class="container">
      <div class="section text-center">
        <h2 class="title">Espetáculos</h2>
      </div>
      <div class="row listaEspetaculos">
      <?php if($espetaculos){ ?>
          <?php foreach($espetaculos as $e): ?>
          <div class="espetaculo col-md-3">
              <h2><?=$e['nomeEspetaculo']; ?></h2>
              <p>Data do evento: <?= $e['dataEspetaculo'] ?></p>
              <p>Numero de lugares: <?= $e['numPoltronas'] ?></p>
              <p>Lugares disponíveis: <?= ($e['numPoltronas'] - $e['numReservas']) ?></p>
              <p style="text-align:center;">
                  <a href="<?= base_url()?>home/reserva/<?= $e['idEspetaculo'] ?>" class="btn btn-primary btn-round">Reservar</a><br/>
                  <a href="<?= base_url()?>home/admReserva/<?= $e['idEspetaculo'] ?>" class="btn btn-info btn-sm" title="Reservas efetuadas até o momento"><i class="material-icons">assignment</i></a>
                  <a href="<?= base_url()?>home/editarEspetaculo/<?= $e['idEspetaculo'] ?>" class="btn btn-info btn-sm" title="Alterar as informações do espetáculo como título, data e numero de lugares"><i class="material-icons">edit</i></a>
                  <a href="<?= base_url()?>home/deletaEspetaculo/<?= $e['idEspetaculo'] ?>" class="btn btn-danger btn-sm" title="Excluir o Espetáculo e suas reservas"><i class="material-icons">delete_forever</i></a>
              </p>
          </div>
      <?php endforeach; ?>
      <?php }else{ ?>
        <div class="alert alert-info" style="margin-bottom: 20px !important;">
            <div class="container">
                <div class="alert-icon">
                    <i class="material-icons">info_outline</i>
                </div>
                Não há espetáculos cadastrados!
            </div>
        </div>
        <br />
      <?php } ?>
      </div>
    </div>
  </div>
  