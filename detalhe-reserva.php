<?php
session_start();

require './config/init.php';

require './config/functions.php';

//Get reservas do usuários
$reservas_usuario = obterReservasUsuario();

//$poltronas = getReservasFromEspetaculo($id_espetaculo);
//Get total arrecadação
$valor_total = obterTotalArrecadacao();
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
        <script type="text/javascript" src="public/js/scripts-reserva.js"></script>        
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">Teatro</a>
                    <a class="navbar-brand" href="admin">Área administrativa</a>
                </div>
            </div>
        </nav>
        <div class="jumbotron">
            <div class="container"> 
                <h2>Minhas reservas - Detalhes</h2>
                <p>
                    Valor Total: <?php echo moeda($valor_total->valortotal); ?>
                </p>
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
                            <th>Reserva</th>
                            <th>Valor</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas_usuario as $reserva): ?>
                            <tr id="tr_<?php echo $reserva->id_reserva; ?>">
                                <td><?= $reserva->espetaculo; ?></td>
                                <td><?= $reserva->date; ?></td>
                                <td><?= $reserva->hora; ?></td>
                                <td><?= $reserva->id_reserva; ?></td>
                                <td><?php echo moeda($reserva->valor); ?></td>
                                <td>
                                    <a href="" class="btn btn-primary" id="btn-detalhe" data-toggle="modal" data-target="#cancelar-reserva" data-id="<?php echo $reserva->id_reserva; ?>">Detalhes</a>
                                    <button type="button" class="btn btn-danger remover" data-id="<?php echo $reserva->id_reserva; ?>">Remover</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Cancelar Poltrona -->
            <div class="modal fade" id="cancelar-reserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" ></h4>
                            <h5 id="titulo">Poltronas reservadas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" id="dynamic-content" ></div>
                    </div>
                </div>
            </div>

            <div class="clearfix">
                <a href='index.php' class="btn btn-success">Voltar</a>
            </div> 
        </div> 
    </body>
</html>