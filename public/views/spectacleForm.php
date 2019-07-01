<?php
require_once('template/header.php');
require_once('template/topo.php');
?>
  <section class="content">

    <div class="topo">
      <h1><?=(isset($id) && $id) ? 'Editar Espetáculo' : 'Adicionar Espetáculo'?></h1>
    </div>

    <form method="post" action="index.php/spectacle/save" class="card form shadow">
      <input name="id" type="hidden" value="<?=(isset($spectacle['id']) && $spectacle['id']) ? $spectacle['id'] : ''?>">
      <div class="input-container">
        <input placeholder=" " id="iNome" type="text" name="name" required value="<?=(isset($spectacle['name']) && $spectacle['name']) ? $spectacle['name'] : ''?>">
        <label for="iNome">Nome do Espetáculo *</label>
      </div>
      <div class="input-container">
        <textarea placeholder=" " id="iDesc" type="text" name="description" required><?=(isset($spectacle['description']) && $spectacle['description']) ? $spectacle['description'] : ''?></textarea>
        <label for="iDesc">Descrição *</label>
      </div>
      <div class="opcoes">
          <a href="javascript:history.back()" class="btn">Cancelar</a>
          <button type="submit" class="btn color">Salvar</button>
      </div>
    </form>
  </section>

<?php
require_once('template/footer.php');
?>