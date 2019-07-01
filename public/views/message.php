<?php
require_once('template/header.php');
?>
  <section class="content">

    <div class="topo">
      <h1><?=(isset($message) && $message) ? $message : 'Nem sei o que dizer'?></h1>
    </div>

    <p>Redirecionando...</p>
  </section>

<?php
require_once('template/footer.php');
?>