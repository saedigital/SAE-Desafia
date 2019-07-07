<?php
require_once (__DIR__ .'/../../Models/Show.php');
$show = new Show();
$results = $show->consulta($show->getTable());
?>
<!DOCTYPE html>
<html lang="br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Desafio Espetaculo SAE</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
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
                            <h3>Relatório de Espetáculos</h3>
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
                <div class="col-sm-4 col-md-4">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <img src="img/img-1.png" class="img-responsive" alt="" />
                    </div>
                </div>
                <div class="col-sm-8 col-md-8">
                    <div class="panel panel-skin">
                        <div class="panel-heading">
                            <div class="col-sm-6 col-md-6">
                                <h3 class="panel-title"><span class="fa fa-database"></span> Relatório</h3>
                            </div>
                            <div class="col-sm-6 col-md-6" style="float: right">
                                <a href="cad-show" style="color: white"><h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Espetáculo</h3></a>
                            </div>
                        </div>
                        <div class="panel-body">

                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>qtd-Poltronas</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($results as $valor)
                                {
                                    $origDate =  $valor['data_espetaculo'];
                                    $date = str_replace('-', '/', $origDate );
                                    echo '<tr id="'.$valor['id'].'">
                                                        <td>'.$valor['nome'].'</td>
                                                        <td>'.$valor['qtd_poltronas'].'</td>                                                       
                                                        <td>'.date("d/n/Y", strtotime($date)).'</td>
                                                        <td><button class="btn btn-default update_cliente btn btn-warning btn-rounded btn-condensed btn-xs"  id="'.$valor['id'].','.utf8_encode($valor['nome']).','.utf8_encode($valor['qtd_poltronas']).','.date("Y-m-d", strtotime($valor['data_espetaculo'])).'" data-toggle="tooltip" title="Atualizar"><span class="fa fa-pencil fa-1g"></span></button>
	                                                        <button type="button" id="'.$valor['id'].','.utf8_encode($valor['nome']).'" data-toggle="tooltip" title="Excluir !" class="delete_espetaculo btn btn-danger btn-condensed btn-xs" ><i class="fa fa-trash fa-1g"></i></button></td>
                                                    </tr>';
                                }
                                ?>


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Perfil</th>
                                    <th>Ações</th>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

</div>
<script language="JavaScript" src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>
<script type='text/javascript' src='js/plugins/noty/jquery.noty.js'></script>
<script type='text/javascript' src='js/plugins/noty/layouts/center.js'></script>
<script type='text/javascript' src='js/plugins/noty/themes/default.js'></script>
<script type="text/javascript">
    $(function() {
        $(".delete_espetaculo").click(function() {

            var commentContainer = $(this).parent();
            var valor = $(this).attr("id");
            var dataArray = valor.split(',');
            var id  = 'id='+ dataArray[0] ;

            var apagar = dataArray[0];
            var dados  = id;

            noty({
                text: 'Deseja <b><u>EXCLUIR</u></b> o Espetáculo ?<hr> <b>'+dataArray[1]+'</b>',
                layout: 'center',
                buttons: [
                    {addClass: 'btn btn-success btn-clean btn-xs', text: 'Ok', onClick: function($noty) {

                            $.ajax({
                                type: "POST",
                                url: "excluir-espetaculo",
                                data: dados,
                                cache: false,
                                success: function(){
                                    commentContainer.slideUp('slow', function() {$(this).remove();});
                                    $('#'+apagar).fadeOut();
                                }
                            });
                            $noty.close();
                        }
                    },
                    {addClass: 'btn btn-danger btn-clean btn-xs', text: 'Cancel', onClick: function($noty) {
                            $noty.close();
                        }
                    }
                ]
            })
            return false;
        });
    });

    $(function() {
        $(".update_cliente").click(function() {

            var commentContainer = $(this).parent();
            var valor = $(this).attr("id");
            var dataArray = valor.split(',');
            var id  = 'id='+ dataArray[0] ;
            var nome = 'nome='+dataArray[1];
            var qtd_poltronas = 'qtd_poltronas='+dataArray[2];
            var data_espetaculo = 'data_espetaculo='+dataArray[3];

            var dados  = id+'&'+nome+'&'+qtd_poltronas+'&'+data_espetaculo;

            noty({
                text: 'Deseja <b><u>ATUALIZAR</u></b> o Espetáculo ?<hr> <b>'+dataArray[1]+'</b>',
                layout: 'center',
                buttons: [
                    {addClass: 'btn btn-success btn-clean btn-xs', text: 'Ok', onClick: function($noty) {

                            $.ajax({
                                type: "GET",
                                url: "atualizar-espetaculo",
                                data: dados,
                                cache: true,
                                success: function(){
                                    window.location.href = "atualizar-espetaculo?"+dados;
                                }
                            });
                            $noty.close();
                        }
                    },
                    {addClass: 'btn btn-danger btn-clean btn-xs', text: 'Cancel', onClick: function($noty) {
                            $noty.close();
                        }
                    }
                ]
            })
            return false;
        });
    });
</script>
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/actions.js"></script>
</body>
</html>
