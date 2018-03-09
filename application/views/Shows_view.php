<?php if(!isset($shows)): ?>

<div class="alert alert-info">
  Não há espetáculos cadastrados
</div>

<?php else: ?>

<div class="alert alert-info">
  Escolha o espetáculo que mais lhe agrada e reserve sua poltrona.
</div>

<div class="shows-wrapper row">
  <?php
  foreach($shows as $show):
    $about = (strlen($show->description) > 100) ? $show->excerpt.'...' : $show->description;
    $start = substr($show->start_date_br,0,5) .' às '. $show->start_time;
    $value = number_format($show->seating_value, 2, ',', '.');
    if($show->seat_enable > 0):
  ?>
    <!-- Enabled -->
    <div class="col-lg-3 col-md-4 col-sm-6">
      <div class="show card border-secondary">
        <div class="card-body text-default">
          <h5 class="card-title"><?php echo $show->title ?></h5>
          <p><?php echo $about ?></p>
          <ul>
            <li title="Início"><i class="oi oi-calendar"></i> <?php echo $start ?></li>
            <li title="Duração"><i class="oi oi-timer"></i> <?php echo $show->duration_min ?> minutos</li>
            <li title="Valor da poltrona"><i class="oi oi-dollar"></i> R$ <?php echo $value ?></li>
            <li title="<?php echo $show->seat_enable ?> poltronas disponíveis num total de <?php echo $show->seating_total ?>">
              <i class="oi oi-lock-unlocked"></i> <?php echo $show->seat_enable ?> poltronas disponíveis
            </li>
          </ul>
        </div>
        <div class="card-footer">
          <a href="<?php echo base_url('shows/details/'.$show->id) ?>" class="btn btn-success buy-seat form-control"><i class="oi oi-cart"></i> Comprar</a>
        </div>
      </div>
    </div>

  <?php else: ?>
    <!-- Disabled -->
    <div class="col-lg-3 col-md-4 col-sm-6">
      <div class="show card border-default">
        <div class="card-body text-secondary">
          <h5 class="card-title"><?php echo $show->title ?></h5>
          <p><?php echo $about ?></p>
          <ul>
            <li title="Início"><i class="oi oi-calendar"></i> <?php echo $start ?></li>
            <li title="Duração"><i class="oi oi-timer"></i> <?php echo $show->duration_min ?> minutos</li>
            <li title="Valor da poltrona"><i class="oi oi-dollar"></i> R$ <?php echo $value ?></li>
            <li title="Não há poltronas disponíveis"><i class="oi oi-lock-locked"></i> Esgotado</li>
          </ul>
        </div>
        <div class="card-footer">
          <button class="btn btn-secondary form-control" disabled><i class="oi oi-thumb-down"></i> Esgotado</button>
        </div>
      </div>
    </div>
  <?php endif; endforeach; ?>

</div>

<?php endif; ?>
