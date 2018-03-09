<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/shows') ?>">Espetáculos</a></li>
    <li class="breadcrumb-item active"><?php echo $title ?></li>
  </ol>
</nav>

<div class="row">
  <div class="col-lg-6">

  <?php echo form_open(base_url('admin/shows/insert')) ?>

  <div class="form-group row">
    <!-- title -->
      <label for="inputEmail3" class="col-sm-2 col-form-label">Título</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="title" name="title" autocomplete="off" required>
      </div>
    </div>
    <!-- seating total -->
    <div class="form-group row">
      <label for="seating_total" class="col-sm-2 col-form-label">Poltronas</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="seating_total" name="seating_total" min="1" max="9999" value="50" maxlength="4" required>
      </div>
    </div>
    <!-- seating value -->
    <div class="form-group row">
      <label for="seating_value" class="col-sm-2 col-form-label">Valor por poltrona</label>
      <div class="col-sm-10">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">R$</span>
          </div>
          <input type="number" class="form-control" id="seating_value" name="seating_value" value="23.76" required>
        </div>
      </div>
    </div>
    <!-- start -->
    <div class="form-group row">
      <label for="start_date" class="col-sm-2 col-form-label">Início</label>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-sm-6">
            <input type="date" class="form-control" id="start_date" aria-describedby="start_date_help" name="start_date" min="<?php echo date("Y-m-d") ?>" required>
            <small id="start_date_help" class="text-muted">Data do espetáculo.</small>
          </div>
          <div class="col-sm-6">
            <input type="time" class="form-control" id="start_time" aria-describedby="start_time_help" name="start_time" required>
            <small id="start_time_help" class="text-muted">Hora de início.</small>
          </div>
        </div>
      </div>
    </div>
    <!-- duration -->
    <div class="form-group row">
      <label for="duration" class="col-sm-2 col-form-label">Duração</label>
      <div class="col-sm-10">
        <input type="time" class="form-control" id="duration" name="duration" required>
      </div>
    </div>
    <!-- description -->
    <div class="form-group row">
      <label for="description" class="col-sm-2 col-form-label">Descrição</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="description" name="description"></textarea>
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

  <div class="col-lg-6">
  </div>

</div>
