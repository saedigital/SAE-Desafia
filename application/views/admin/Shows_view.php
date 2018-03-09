<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Espetáculos</li>
  </ol>
</nav>

<div>
  <p class="text-right"><a class="btn btn-info btn-lg" href="<?php echo base_url('admin/shows/insert') ?>">Incluir espetáculo</a></p>
</div>

<table class="table">
  <tr>
    <th class="title">Titulo</th>
    <th class="start">Início</th>
    <th class="duration">Duração</th>
    <th class="sold">Poltronas vendidas</th>
    <th class="colletion">Arrecadação</th>
    <th class="colletion"></th>
  </tr>
  <?php foreach ($content as $show): ?>
    <tr>
      <td><?php echo '<a title="Editar espetáculo" href="'.base_url('admin/shows/update/'.$show->id).'">' . $show->title . '</a>' ?></td>
      <td><?php echo $show->start_br ?></td>
      <td><?php echo $show->duration_br ?></td>
      <td title="Vendidas <?php echo $show->total_seat?> poltronas num total de <?php echo $show->seating_total ?>"><?php echo $show->total_seat .' / '. $show->seating_total ?></td>
      <td>R$ <?php echo number_format($show->total_sold, 2, ',', '.') ?></td>
      <td>
        <a title="Editar espetáculo"
          href="<?php echo base_url('admin/shows/update/'.$show->id) ?>"
          class="btn btn-info btn-sm">
          <i class="oi oi-pencil"></i></a>
        <a title="Excluir espetáculo"
          href="<?php echo base_url('admin/shows/delete/'.$show->id) ?>"
          class="btn btn-danger btn-sm"
          data-toggle="modal"
          data-target="#deleteModal">
          <i class="oi oi-trash"></i></a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<div id="deleteModal" class="modal delete fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Excluir espetáculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja excluir este espetáculo?</p>
        <p>Dados relacionados serão perdidos e esta operação não poderá ser desfeita.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger submit">Excluir</button>
      </div>
    </div>
  </div>
</div>
