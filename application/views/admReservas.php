  <div class="main main-raised">
    <div class="container">
      <div class="section text-center">
        <h2 class="title">Reservas do espetáculo <?= $e['nomeEspetaculo'] ?></h2>
      </div>
        
      <div class="col-md-12">
          <p class="text-success">Total de Faturamento: <b>R$ <?= $faturamento ?></b></p>
          
          <?php if($reservas){ ?>
          <table class="col-md-12 table-striped">
              <tr>
                <th>Nome do Cliente</th>
                <th>Data da Reserva</th>
                <th>Ação</th>
              </tr>
          <?php foreach($reservas as $r): ?>
          <tr>
              <td><?=$r['nomeCliente']; ?></td>
              <td><?= $r['dataReserva'] ?></td>
              <td style="text-align:center;"><a href="<?= base_url()?>home/cancelarReserva/<?= $r['idReserva'] ?>/<?= $r['idEspetaculo'] ?>" class="btn btn-danger btn-sm">Cancelar</a></td>
          </tr>
      <?php endforeach; ?>
          </table>
      <?php }else{ ?>
        <div class="alert alert-info" style="margin-bottom: 20px !important;">
            <div class="container">
                <div class="alert-icon">
                    <i class="material-icons">info_outline</i>
                </div>
                Não há reservas cadastradas!
            </div>
        </div>
        <br />
      <?php } ?>
      </div>
    </div>
  </div>
  