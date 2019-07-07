<?php
@$id = $_GET['id'];
@$nome = $_GET['nome'];
@$qtd_poltronas = $_GET['qtd_poltronas'];
@$data_espetaculo = $_GET['data_espetaculo'];
@$tipo = $_GET['tipo'];
@$enviar = $tipo == null ? 'save-espetaculo' : 'save-atu-espetaculo';
?>
<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Desafio Agendar Poltrona espetáculo SAE</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet">
    <!-- boxed bg -->
    <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />
    <!-- template skin -->
    <link id="t-colors" href="color/default.css" rel="stylesheet">
    <style type="text/css">
        * {
            font-family: Verdana;
            font-size: 96%;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        label.error {
            float: none;
            color: red;
            margin: 0 .5em 0 0;
            vertical-align: top;
            font-size: 10px
        }
        p {
            clear: both;
        }
        .submit {
            margin-top: 1em;
        }
        em {
            font-weight: bold;
            padding-right: 1em;
            vertical-align: top;
        }
    </style>
</head>



<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
<div id="wrapper">
    <section id="callaction" class="home-section paddingtop-40">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-8">
                        <div class="cta-text">
                            <h3>Cadastro de Espetáculo</h3>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <a href="/">
                            <div class="cta-btn">
                                <img src="img/logo.jpg" class="img-responsive" alt="" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="service" class="home-section nopadding paddingtop-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <img src="img/img-1.png" class="img-responsive" alt="" />
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="panel panel-skin">
                        <div class="panel-heading">
                            <div class="col-sm-6 col-md-6">
                                <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Espetáculo</h3>
                            </div>
                            <div class="col-sm-6 col-md-6" style="float: right">
                                <a href="rel-show" style="color: white"><h3 class="panel-title"><span class="fa fa-database"></span> Relatório</h3></a>
                            </div>
                        </div>
                        <div class="panel-body">


                            <form class="lead" id="espetaculo" onSubmit="return validar(this);" action="<?=$enviar?>" method="post">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Espetáculo</label>
                                            <input type="text" required="required" class="form-control input-md" name="Nome" id="Nome" value="<?= $nome; ?>"  placeholder="Digite o Nome do Espetáculo"/>
                                            <input type="hidden" value="<?=$id?>" name="id" id="id" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Quantidade de Poltronas</label>
                                            <input type="text" class="form-control input-md" required="required" id="qtd_poltrona" name="qtd_poltrona" value="<?=$qtd_poltronas?>" maxlength="3" placeholder="Digite a quantidade de poltronas" pattern="[0-9]+$" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Data do espetáculo <?=$data_espetaculo?></label>
                                            <input type="date" required="required" class="form-control input-md" name="date" id="date" value="<?=$data_espetaculo?>"  placeholder="Digite a Data do Espetáculo"/>
                                        </div>
                                </div>
                                <input type="submit" value="Cadastrar" class="btn btn-skin btn-block btn-lg">
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>



</div>

<script language="JavaScript" src="js/jquery.js" type="text/javascript"></script>

<script language="JavaScript" src="js/jquery.validate.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('#qtd_poltrona').keyup(function() {
        $(this).val(this.value.replace(/\D/g, ''));
    });
</script>
<script>

    $(document).ready( function() {

        $("#espetaculo").validate({
            rules: {
                Nome: {
                    required: true
                },
                qtd_poltrona :{
                    required: true
                },
                date :{
                    required: true
                },
            },
            messages: {
                Nome: {
                    required: "Digite o Nome do Espetáculo"
                },
                qtd_poltrona: {
                    required: "Digite a quantidade de poltronas"
                },
                date: {
                    required: "Digite a data do Espetáculo"
                }
            }
        });

    });

</script>
</body>
</html>

