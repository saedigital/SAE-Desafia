<?php
session_start();

require './config/init.php';

require './config/functions.php';

//Get all espetaculos
$espetaculos = obterTodosEspetaculosAdmin();

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
        <title>Área administrativa</title>
        <link rel="icon" href="vista/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
        <script type="text/javascript" src="public/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="public/js/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="public/js/scripts-admin.js"></script>        
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
					<a class="navbar-brand" href="index.php">Página principal</a>
                    <a class="navbar-brand" href="">Área administrativa</a>
                </div>
            </div>
        </nav>

        <div class="jumbotron">
            <div class="container">  
                <h2>Área administrativa </h2>
                <p>
                    Valor Total Arrecadado: <?php echo moeda($valor_total->valortotal) ; ?>
                </p>
                <p>
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#novo">
                        Criar espetáculo
                    </button>
                </p>                
            </div>
        </div>

        <div class="container">  
            <!-- Janela Modal Novo Dado -->
            <div class="modal fade" id="novo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Criar espetáculo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" id="form_cadastro" class="form_cadastro" action="" method="post" >
                                <div class="form-group">
                                    <label for="nome">Espetáculo</label>
                                    <input type="text" required class="form-control" id="nome_espetaculo" name="nome_espetaculo" placeholder="Infome o espetáculo">
                                </div>
                                <div class="form-group">
                                    <label for="dada">Data</label>
                                    <input type="text" required class="form-control" id="data_espetaculo" maxlength="10" name="data_espetaculo" placeholder="Infome a data">
                                </div>
                                <div class="form-group">
                                    <label for="hora">Hora</label>
                                    <input type="text" required class="form-control" id="hora_espetaculo" name="hora_espetaculo" placeholder="Infome a hora">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn crud-submit btn-success">Cadastrar</button>
                                </div>                                    
                            </form>
                        </div>
                    </div>
                </div>           
            </div>

            <!-- Janela Modal Editar Dado -->
            <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Editar espetáculo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" id="form_atualiza" class="form_atualiza" action="" method="post" >
                                <input type="hidden" name="id" class="edit-id">
                                <div class="form-group">
                                    <label for="nome">Espetáculo</label>
                                    <input type="text" required class="form-control" id="nome_espetaculo" name="nome_espetaculo" placeholder="Infome o espetáculo">
                                </div>
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <input type="text" required class="form-control" id="data_espetaculo" maxlength="10" name="data_espetaculo" placeholder="Infome a data">
                                </div>
                                <div class="form-group">
                                    <label for="hora">Hora</label>
                                    <input type="text" required class="form-control" id="hora_espetaculo" name="hora_espetaculo" placeholder="Infome a hora">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success crud-submit-edit">Atualizar</button>
                                </div>                                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Lista de espetáculos</h3>

            <div class="card">
                <table class="table table-striped">
                    <thead>
                        <tr class='active'>
                            <th>Espetáculo</th>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Reservado</th>
                            <th>Disponível</th>
                            <th>Valor arrecadado</th>
                            <th>Ação</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($espetaculos as $espetaculo): ?>
                            <tr id="tr_<?php echo $espetaculo->id_espetaculo; ?>">
                                <td data-esp_nome="<?= $espetaculo->espetaculo; ?>"><?= $espetaculo->espetaculo; ?></td>
                                <td data-esp_data="<?= $espetaculo->date; ?>"><?= $espetaculo->date; ?></td>
                                <td data-esp_hora="<?= $espetaculo->hora; ?>"><?= $espetaculo->hora; ?></td>
                                <td><?= $espetaculo->poltronareservada; ?></td>
                                <td><?= $espetaculo->disponivel; ?></td>
                                <td><?php echo moeda($espetaculo->valortotal); ?></td>
                                <td>
                                    <button type="button" data-toggle="modal" class="btn btn-primary editar" data-target="#editar" data-id="<?php echo $espetaculo->id_espetaculo; ?>">Editar</button>
                                    <button type="button" class="btn btn-danger deletar" data-id="<?php echo $espetaculo->id_espetaculo; ?>" >Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </body>
</html>


