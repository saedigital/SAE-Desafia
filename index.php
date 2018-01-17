<?php
session_start();

require './config/init.php';

require './config/functions.php';

//Obter todos espetaculos
$espetaculos = obterTodosEspetaculos();
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Ander">
        <title>Teatro - Espetáculos</title>
        <link rel="icon" href="vista/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
        <script type="text/javascript" src="public/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="public/js/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">Página principal</a>
                    <a class="navbar-brand" href="admin">Área administrativa</a>
                </div>
            </div>
        </nav>
        <div class="jumbotron">
            <div class="container"> 
                <h2>Teatro - Espetáculos</h2>
                <a class="btn btn-success btn-lg" href="detalhe-reserva.php">Minhas reservas</a>
            </div>
        </div>

        <div class="container">
            <h3>Lista de espetáculos</h3>
            <div class="card">
                <table class="table table-striped">
                    <thead>
                        <tr class='active'>
                            <th>Espetáculo</th>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Poltrona disponível</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($espetaculos as $espetaculo): ?>
                            <tr id="tr_<?php echo $espetaculo->id_espetaculo; ?>">
                                <td><?= $espetaculo->espetaculo; ?></td>
                                <td><?= $espetaculo->date; ?></td>
                                <td><?= $espetaculo->hora; ?></td>
                                <td><?= $espetaculo->disponivel; ?></td>
                                <td>
                                    <a href='espetaculo.php?id=<?= $espetaculo->id_espetaculo ?>' class="btn btn-primary" data-target="#editar" data-id="<?php echo $espetaculo->id_espetaculo; ?>">Reservar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div> 
    </body>
</html>