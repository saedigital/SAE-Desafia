<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="<?php echo $this->config->item('language') ?>">
<head>
  <meta charset="<?php echo $this->config->item('charset') ?>">
  <meta name="author" content="<?php echo $this->config->item('author_name') . ' ('.$this->config->item('author_email').')' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts/css/open-iconic-bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles_admin.css') ?>">
  <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/scripts_admin.js') ?>"></script>
  <title><?php echo implode(' - ', [$this->config->item('project_name'), $title] ) ?></title>
</head>
<body>

<div class="container-fluid">

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="<?php echo base_url('admin') ?>"><?php echo $this->config->item('project_name') ?> Admin</a>

      <?php if($this->session->userdata('logged_in') && $this->session->userdata('is_admin') ): ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu-principal">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item<?php if($this->router->fetch_class() == 'dashboard') echo ' active' ?>">
            <a class="nav-link" href="<?php echo base_url('admin') ?>">Dashboard</a>
          </li>
          <li class="nav-item<?php if($this->router->fetch_class() == 'shows') echo ' active' ?>">
            <a class="nav-link" href="<?php echo base_url('admin/shows') ?>">Espetáculos</a>
          </li>
        </ul>
      </div>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $this->session->userdata('first_name') ?></a>
          <div class="dropdown-menu" aria-labelledby="userMenu">
            <a class="dropdown-item" href="<?php echo base_url() ?>">Ir para o site</a>
            <a class="dropdown-item" href="<?php echo base_url('admin/logout') ?>">Log out</a>
          </div>
        </li>
      </ul>
      <?php endif; ?>

    </nav>
  </header>

  <div class="content page <?php echo implode(' ', [$this->router->fetch_class(), $this->router->fetch_method()]) ?>">
    <?php
    // page title
    if(isset($title)) echo '<h2>'.$title.'</h2>';

    // user message
    if($message = $this->session->flashdata()){
      if(isset($message['success'])) echo '<div class="alert alert-success">'.$message['success'].'</div>';
      if(isset($message['error'])) echo '<div class="alert alert-danger">'.$message['error'].'</div>';
      if(isset($message['info'])) echo '<div class="alert alert-info">'.$message['info'].'</div>';
    }

    // page content
    if(isset($content)) echo '<section>'.$content.'</section>';
    ?>
  </div>

  </footer>
    <p><small>Criado por <a href="mailto:<?php echo $this->config->item('author_email') ?>"><?php echo $this->config->item('author_name') ?></a></small></p>
  </footer>

</div>

</body>
</html>
