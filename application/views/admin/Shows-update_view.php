<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/shows') ?>">Espetáculos</a></li>
    <li class="breadcrumb-item active"><?php echo $title ?></li>
  </ol>
</nav>

<div class="row">
  <div class="col-sm-6">

    <?php echo form_open(base_url('admin/shows/update'), '', ['id'=>$content->id]) ?>

      <div class="form-group row">
        <!-- title -->
          <label for="inputEmail3" class="col-sm-2 col-form-label">Título</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" autocomplete="off" value="<?php echo set_value('title', $content->title) ?>" required>
          </div>
        </div>
        <!-- seating total -->
        <div class="form-group row">
          <label for="seating_total" class="col-sm-2 col-form-label">Poltronas</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="seating_total" name="seating_total" min="<?php echo $last_seat ?>" max="9999" value="<?php echo set_value('seating_total', $content->seating_total) ?>" required>
            <small id="seating_value_help" class="text-muted">Não poderá ser alterado para um número menor que a última poltrona vendida</small>
          </div>
        </div>
        <!-- seating value -->
        <div class="form-group row">
          <label for="seating_value" class="col-sm-2 col-form-label">Valor por poltrona</label>
          <div class="col-sm-10">
            <div class="input-group mb-3 seat_value">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">R$</span>
              </div>
              <input type="number" class="form-control" id="seating_value" name="seating_value" aria-describedby="seating_value_help" value="<?php echo set_value('seating_value', $content->seating_value) ?>" required>
            </div>
            <small id="seating_value_help" class="text-muted">As compras já realizadas não terão o valor alterado.</small>
          </div>
        </div>
        <!-- start -->
        <div class="form-group row">
          <label for="start_date" class="col-sm-2 col-form-label">Início</label>
          <div class="col-sm-10">
            <div class="row">
              <div class="col-sm-6">
                <input type="date" class="form-control" id="start_date" aria-describedby="start_date_help" name="start_date" min="<?php echo date("Y-m-d") ?>" value="<?php echo set_value('start_date', $content->start_date) ?>" required>
                <small id="start_date_help" class="text-muted">Data do espetáculo.</small>
              </div>
              <div class="col-sm-6">
                <input type="time" class="form-control" id="start_time" aria-describedby="start_time_help" name="start_time" value="<?php echo set_value('start_time', $content->start_time) ?>" required>
                <small id="start_time_help" class="text-muted">Hora de início.</small>
              </div>
            </div>
          </div>
        </div>
        <!-- duration -->
        <div class="form-group row">
          <label for="duration" class="col-sm-2 col-form-label">Duração</label>
          <div class="col-sm-10">
            <input type="time" class="form-control" id="duration" name="duration" value="<?php echo set_value('duration', $content->duration) ?>" required>
          </div>
        </div>
        <!-- description -->
        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Descrição</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="description" name="description"><?php echo set_value('duration', $content->description) ?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-lg btn-info">Salvar informações</button>
            <a href="<?php echo base_url('admin/shows') ?>" class="btn btn-default">Voltar para os espetáculos</a>
          </div>
        </div>

      <?php echo form_close() ?>

    </div>

  <div class="col-sm-6">

    <h3>Histórico de vendas</h2>

      <?php if(!$sales): ?>
        <div class="alert alert-warning">Não há vendas de poltronas para este espetáculo até o momento.</div>
      <?php else: ?>

      <div class="alert alert-info">
        Foram vendidas <?php echo count($sales) ?> poltronas num total de <?php echo $content->seating_total ?>, restam <?php echo $content->seating_total - count($sales) ?>.<br>
        Total arrecadado: R$ <?php echo number_format($total_sold, 2, ',', '.') ?>.
      </div>


      <table class="table">
        <thead>
          <tr>
            <th>Cliente</th>
            <th>Poltrona</th>
            <th>Valor pago</th>
            <th>Data e hora</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($sales as $sale): ?>
          <tr>
            <td><?php echo $sale->user_name ?></td>
            <td><?php echo $sale->seat_number ?></td>
            <td>R$ <?php echo number_format($sale->seat_value, 2, ',', '.') ?></td>
            <td><?php echo $sale->created_at_br ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php endif; ?>

  </div>
</div>
