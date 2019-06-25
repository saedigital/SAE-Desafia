<?php
include_once 'config.php';


if (!empty($_GET['acao'])){
  $acao = $_GET['acao'];
} else {
  $acao = 'inicio';
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <title>Reservas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  </head>
  <body>
    <nav>
      <div class="nav-wrapper">
        <a href="index.php" class="brand-logo">Reservas</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="#">Espetáculo</a></li>
          <li><a href='reserva.php?acao=list'>Reserva</a></li>
        </ul>
      </div>
    </nav>
