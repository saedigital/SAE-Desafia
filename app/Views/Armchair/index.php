<?php
require_once (__DIR__ .'/../../Models/Show.php');
$show = new Show();
$results = $show->consulta($show->getTable());

$reservadas = new Armchair();
$reservadas = $reservadas->consulta($reservadas->getTable());

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
                            <h3>Agendar Poltrona</h3>
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
                                <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Espetáculo</h3>
                            </div>
                            <div class="col-sm-6 col-md-6" style="float: right">
                                <a href="rel-show" style="color: white"><h3 class="panel-title"><span class="fa fa-database"></span> Relatório</h3></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="espetaculos">
                                <?php
                                foreach($results as $valor)
                                {
                                    $poltronasReservadas = 0;
                                    $poltronasLiberadas = 0;
                                    echo '<h3>'.$valor['nome'].'</h3>
                                            <div>';
                                    for ($p = 0; $p <= $valor['qtd_poltronas']; ) {
                                        if($p < 10) {$p = '0'.$p;}
                                        foreach ($reservadas as $reserva)
                                        {
                                            if (($reserva['idfk_espetaculo'] == $valor['id']) and ($reserva['numero_poltrona'] == $p))
                                            {
                                                echo '<button style="margin: 0 5px" type="button" id="'.$valor['id'].'-'.$p.'-'.$reserva['id'].'" data-toggle="tooltip" title="Poltrona ['.$p.']" class="libera_poltrona btn btn-danger btn-condensed btn-xs" >[ '.$p.' ]<i class="fa fa-user fa-1g"></i></button>';
                                                $poltronasReservadas++;
                                                $p++;
                                            }
                                        }
                                        echo '<button style="margin: 0 5px" type="button" id="'.$valor['id'].'-'.$p.'" data-toggle="tooltip" title="Poltrona ['.$p.']" class="reserva_poltrona btn btn-info btn-condensed btn-xs" >[ '.$p.' ]<i class="fa fa-user fa-1g"></i></button>';
                                        $p++;
                                        $poltronasLiberadas++;
                                    }
                                    echo '<hr>Poltronas Reservadas <b>'.$poltronasReservadas.'</b>';
                                    echo '<hr>Poltronas Liberadas <b>'.($poltronasLiberadas - 1).'</b>';
                                    echo'</div>';
                                }
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#espetaculos" ).accordion();
    } );
</script>
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
        $(".reserva_poltrona").click(function() {

            var commentContainer = $(this).parent();
            var valor = $(this).attr("id");
            var dataArray = valor.split('-');
            var id  = 'id_espetaculo='+ dataArray[0] ;
            var numero_poltrona = 'numero_poltrona='+ dataArray[1];
            var dados  = id+'&'+numero_poltrona;

            noty({
                text: 'Poltrona <b>[ <u>'+dataArray[0]+'</u> ]</b> no valor de R$: 23,76 ?<hr> <b>RESERVADA</b>',
                layout: 'center',
                buttons: [
                    {addClass: 'btn btn-success btn-clean btn-xs', text: 'Ok', onClick: function($noty) {

                            $.ajax({
                                type: "POST",
                                url: "reserva",
                                data: dados,
                                cache: false,
                                success: function(){
                                    $("#"+valor).removeClass("reserva_poltrona btn btn-info btn-condensed btn-xs");
                                    $("#"+valor).addClass("libera_poltrona btn btn-danger btn-condensed btn-xs");
                                    location.reload();
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
        $(".libera_poltrona").click(function() {

            var commentContainer = $(this).parent();
            var valor = $(this).attr("id");
            var dataArray = valor.split('-');
            var id  = 'id='+ dataArray[2] ;


            var dados  = id;

            noty({
                text: 'Poltrona <b>[ <u>'+valor+'</u> ]</b> <hr> <b>CANCELADA A RESERVADA</b>',
                layout: 'center',
                buttons: [
                    {addClass: 'btn btn-success btn-clean btn-xs', text: 'Ok', onClick: function($noty) {

                            $.ajax({
                                type: "POST",
                                url: "libera",
                                data: dados,
                                cache: false,
                                success: function(){
                                    $("#"+dataArray[0]).removeClass("libera_poltrona btn btn-danger btn-condensed btn-xs");
                                    $("#"+dataArray[0]).addClass("reserva_poltrona btn btn-info btn-condensed btn-xs");
                                    location.reload();
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

