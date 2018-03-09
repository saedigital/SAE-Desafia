<?php
// var_dump($show);
$start = substr($show->start_date_br,0,5) .' às '. $show->start_time;
$value = number_format($show->seating_value, 2, ',', '.');
$my_seat = [];
$disabled = [];
if(isset($show->my_seat)){
  foreach($show->my_seat as $seat) $my_seat[] = $seat->seat_number;
}
$my_seat_total = count($my_seat);

foreach($show->disabled as $seat){
  if(!in_array($seat->seat_number, $my_seat)) $disabled[] = $seat->seat_number;
}


$form_attr = ['id'=>'reserve_form'];
$form_hidden = ['id'=>$show->id, 'seat_value'=>$show->seating_value];
echo form_open(base_url('shows/reserve'), $form_attr, $form_hidden);
?>

<div class="row">
  <div class="col-lg-8">

    <div class="seat-wrapper">
      <?php for($a=1; $a<=$show->seating_total; $a++): ?>

        <?php if(in_array($a, $my_seat)): ?>
          <div class="seat rounded bg-success">
            <a title="Cancelar reserva"
              href="<?php echo base_url('shows/cancel/'.$show->id.'/'.$a) ?>"
              data-toggle="modal"
              data-target="#deleteModal"><?php echo $a ?> <i class="oi oi-trash text-danger"></i></a>
          </div>

        <?php elseif(in_array($a, $disabled)): ?>
          <div class="seat rounded bg-secondary">
            <span class="label"><?php echo $a ?></span>
          </div>

        <?php else: ?>
          <div class="seat rounded bg-info">
            <label class="label" for="seat_<?php echo $a ?>" title="Reservar">
              <?php echo $a ?>
              <input type="checkbox" name="seating[]" id="seat_<?php echo $a ?>" value="<?php echo $a ?>">
            </label>
          </div>
        <?php endif; ?>

      <?php endfor; ?>
    </div>
    <div class="legend">
      <h6>Legenda</h6>
      <ul>
        <li><span class="rounded bg-info"></span> Disponível</li>
        <li><span class="rounded bg-secondary"></span> Indisponível</li>
        <li><span class="rounded bg-warning"></span> Selecionada</li>
        <li><span class="rounded bg-success"></span> Sua reserva confirmada</li>
      </ul>
    </div>
  </div>

  <div class="col-lg-4">

    <div class="confirm">
      <p class="status">Escolha uma ou mais poltronas</p>
      <button type="submit" class="btn btn-lg btn-success form-control" disabled><i class="oi oi-thumb-up"></i> Confirmar</button>
    </div>

    <hr>

    <div class="about">
      <h4>Sobre o espetáculo</h4>
      <ul>
        <li title="Início"><i class="oi oi-calendar"></i> <?php echo $start ?></li>
        <li title="Duração"><i class="oi oi-timer"></i> <?php echo $show->duration_min ?> minutos</li>
        <li title="Valor da poltrona"><i class="oi oi-dollar"></i> R$ <?php echo $value ?></li>
        <li title="<?php echo $show->seat_enable ?> poltronas disponíveis num total de <?php echo $show->seating_total ?>" class="text-info">
          <i class="oi oi-lock-unlocked"></i> <?php echo $show->seat_enable ?> poltronas disponíveis num total de <?php echo $show->seating_total ?>
        </li>
        <li title="<?php echo $show->seat_enable ?> poltronas reservadas" class="text-secondary">
          <i class="oi oi-lock-locked"></i> <?php echo count($disabled) + $my_seat_total ?> poltronas reservadas<?php if($my_seat_total > 0) echo ', destas, <strong class="text-success">'.$my_seat_total.' são suas</strong>' ?>
        </li>
      </ul>
    </div>

    <?php if(strlen($show->description) > 0): ?>
      <div class="description">
        <h5>Sinopse</h5>
        <p><?php echo $show->description ?></p>
      </div>
    <?php endif; ?>
  </div>

</div>

<?php echo form_close() ?>

<div id="deleteModal" class="modal delete fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cancelar reserva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja cancelar esta reserva?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-danger submit">Sim</button>
      </div>
    </div>
  </div>
</div>
