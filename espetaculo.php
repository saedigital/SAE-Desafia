<?php
session_start();

require './config/init.php';

require './config/functions.php';

//Recebe o id via GET
$id_espetaculo = (isset($_GET['id'])) ? $_GET['id'] : '';

//Get espetáculo
$espetaculo = obterEspetaculo($id_espetaculo);

if (empty($espetaculo)) {
    echo 'Não existe';
    header('location: ' . dirname($_SERVER['PHP_SELF']) . '/404.php');
}

//Obter poltronas reservas do espetáculo
$poltronas = obterReservasEspetaculo($id_espetaculo);

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Ander">
        <?php if (empty($espetaculo)): ?>
            <title>Espetáculo não encontrado</title>
        <?php else: ?>
            <title><?= $espetaculo->espetaculo; ?> </title>
        <?php endif; ?>
        <link rel="icon" href="vista/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="public/css/jquery.seat-charts.css">
        <link rel="stylesheet" type="text/css" href="public/css/seat-chars-custom.css">
        <script type="text/javascript" src="public/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="public/js/jquery.seat-charts.min.js"></script> 
        <script type="text/javascript" src="public/js/scripts-reserva.js"></script>

        <!-- Script para preencher as poltronas reservadas -->
        <script type="text/javascript">
            $(document).ready(function ()
            {
                var sc = $('#seat-map').seatCharts();
                <?php
                $array_poltronas = '';
                foreach ($poltronas as $poltrona):
                    $array_poltronas = $array_poltronas . ',' . "'" . $poltrona->poltrona . "'";
                endforeach;
                echo "sc.get([" . $array_poltronas . "]).status('unavailable')";
                ?>
            });
        </script>

    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <ul class="nav navbar-nav">
                        <li> <a class="navbar-brand" href='index.php' >Página principal</a></li>
                        <li> <a class="navbar-brand" href=''>Espetáculo: <?= $espetaculo->espetaculo; ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="jumbotron">
            <div class="container">
                <h2>Espetáculo: <?= $espetaculo->espetaculo; ?></h2>
                <h4>Data: <?= $espetaculo->date; ?></h4>
                <h4>Hora: <?= $espetaculo->hora; ?></h4>
            </div> 
        </div> 
        <div class="container">
            <fieldset>
                <div id="seat-map">
                    <div class="front-indicator">Palco</div>
                </div>
                <input type="hidden" id="valor_poltrona" value="<?php echo obterValorPoltrona()->valor; ?>">
                <div class="booking-details">
                    <h2>Reserva </h2>
                    Total: <b>R$ <span id="total">0</span></b>
                    <h3> Poltronas: <span id="counter">0</span></h3>
                    <ul class="list-group" id="selected-seats"></ul>
                    <div id="legend"></div>
                </div>
            </fieldset>   

            <div class="clearfix">
                <a href='index.php' class="btn btn-success">Voltar</a>
                <button type="button" class="btn btn-primary reservar">
                    Reservar
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancelar-reserva">
                    Cancelar Poltrona
                </button>
            </div> 
        </div>

        <div class="container"> 

            <!-- Cancelar Poltrona -->
            <div class="modal fade" id="cancelar-reserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Cancelar reserva de poltronas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr class='active'>
                                        <th>Poltrona</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($poltronas as $poltrona): ?>
                                        <tr id="tr_<?php echo $poltrona->id_poltrona; ?>">
                                            <td><?= $poltrona->poltrona; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger deletar" data-id="<?php echo $poltrona->id_poltrona; ?>" >Remover</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "resultado"></div>
        </div>
    </body> 
</html>