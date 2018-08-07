<html>
<head>
    <title>Reserve</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de reservas para espetáculos">
    <meta name="author" content="Ubiratã Carvalho">
    <link href="/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <style>
        h1{
            font-size: 2em;
            color:#666666;
        }
        .list-group-item.active{
            background-color:#cccccc;
            border-color:#cccccc;
            color:#333333;
        }
        .list-group-item .badges{
            font-size:1.3em;
        }
        .poltronasGrid{
            text-align: center;
        }
        .poltronasGrid a{
            font-weight: bold;
            font-size: 1.2em;
            color:#666666;
        }
        .poltronasGrid a.bg-secondary{
            color:#ffffff;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <h1>Reserve</h1>
        </nav>
    </header>
    <main class="container-fluid">
                        
        <?php if(!empty($_SESSION['__alert'])){ ?>
            <?php $__alert = $_SESSION['__alert']; ?>            
                <div class="m-1 alert alert-<?=$__alert['context']?> alert--flash">
                    <?=$__alert['content']?>
                </div>                
            <?php unset($_SESSION['__alert']); ?>
        <?php } ?>
        
        <div class="row mt-3">
        
            <section class="col-lg-3">
            <h2>Espetáculos</h2><hr>
            
            <button class="btn btn-lg btn-block btn-light mb-3" data-toggle="modal" data-target="#espetaculoModalAdd">Adicionar Espetáculo</button>

            <div class="list-group" id="list-tab">
                <?php $contador = 0; ?>
                <?php foreach($espetaculos as $espetaculo){ ?>
                <?php $active = $contador == 0 ? 'active' : ''; ?>
                <a class="list-group-item list-group-item-action <?=$active?>" id="espetaculo-<?=$espetaculo['id']?>" data-toggle="list" href="#poltronas-<?=$espetaculo['id']?>" role="tab" aria-controls="home">
                    <h5><small>#<?=$espetaculo['id']?></small> <?=$espetaculo['titulo']?></h5>
                    <div class="mb-2 px-2">
                        <div class="m-auto" >R$<?=number_format($espetaculo['valor'],2,',','.')?>/Poltrona</div>
                    </div>
                    <div class="badges px-2 pb-2">
                        <span class="badge badge-light poltronasDisponiveis">Disponíveis <span>0</span></span>
                        <span class="badge badge-secondary poltronasReservadas">Reservadas <span>0</span></span>                        
                    </div>
                    <div class="d-flex flex-fill">
                        <button type="button" class="buttonEdit flex-fill m-1 btn btn-light btn-sm" data-toggle="modal" data-target="#espetaculoModalEdit-<?=$espetaculo['id']?>">Editar Espetáculo</button>
                        <button type="button" class="buttonDelete flex-fill m-1 btn btn-light btn-sm" data-id="<?=$espetaculo['id']?>" >Remover Espetáculo</button>
                    </div>
                </a>
                <?php $contador++; ?>
                <?php } ?>

            </div>
            
        </section>
        
        <section class="col-lg-9">
            <h2>Poltronas</h2><hr>
            <div class="tab-content" id="poltronasContent" data-poltronas-json='<?=$poltronasJson?>' data-poltronas-total="<?=__POLTRONAS_TOTAL?>" >
            
                <?php $contador = 0; ?>
                <?php foreach($espetaculos as $espetaculo){ ?>
                <?php $active = $contador == 0 ? 'active' : ''; ?>   
                <div class="tab-pane fade show <?=$active?>" id="poltronas-<?=$espetaculo['id']?>">                    
                    
                    <h3><?=$espetaculo['titulo']?></h3>
                    <div class="ml-auto mb-3 valorTotal">Arrecadação R$<span>1000,00</span></div>        
                    
                    <div class="poltronasGrid bg-width" data-espetaculo="<?=$espetaculo['id']?>" >
                        <div class="container-fluid">
                            <div class="row">
                                <a href="#!"  data-poltrona="A1"  class="A1 col p-4 m-1 bg-light rounded desocupado">A1</a>
                                <a href="#!"  data-poltrona="A2"  class="A2 col p-4 m-1 bg-light rounded desocupado">A2</a>
                                <a href="#!"  data-poltrona="A3"  class="A3 col p-4 m-1 bg-light rounded desocupado">A3</a>
                                <a href="#!"  data-poltrona="A4"  class="A4 col p-4 m-1 bg-light rounded desocupado">A4</a>
                                <a href="#!"  data-poltrona="A5"  class="A5 col p-4 m-1 bg-light rounded desocupado">A5</a>
                                <a href="#!"  data-poltrona="A6"  class="A6 col p-4 m-1 bg-light rounded desocupado">A6</a>
                                <a href="#!"  data-poltrona="A7"  class="A7 col p-4 m-1 bg-light rounded desocupado">A7</a>
                                <a href="#!"  data-poltrona="A8"  class="A8 col p-4 m-1 bg-light rounded desocupado">A8</a>
                                <a href="#!"  data-poltrona="A9"  class="A9 col p-4 m-1 bg-light rounded desocupado">A9</a>
                                <a href="#!"  data-poltrona="A10" class="A10 col p-4 m-1 bg-light rounded desocupado">A10</a>
                            </div>
                            <hr class="clearfix">
                            <div class="row">
                                <a href="#!"  data-poltrona="B1"  class="B1 col p-4 m-1 bg-light rounded desocupado">B1</a>
                                <a href="#!"  data-poltrona="B2"  class="B2 col p-4 m-1 bg-light rounded desocupado">B2</a>
                                <a href="#!"  data-poltrona="B3"  class="B3 col p-4 m-1 bg-light rounded desocupado">B3</a>
                                <a href="#!"  data-poltrona="B4"  class="B4 col p-4 m-1 bg-light rounded desocupado">B4</a>
                                <a href="#!"  data-poltrona="B5"  class="B5 col p-4 m-1 bg-light rounded desocupado">B5</a>
                                <a href="#!"  data-poltrona="B6"  class="B6 col p-4 m-1 bg-light rounded desocupado">B6</a>
                                <a href="#!"  data-poltrona="B7"  class="B7 col p-4 m-1 bg-light rounded desocupado">B7</a>
                                <a href="#!"  data-poltrona="B8"  class="B8 col p-4 m-1 bg-light rounded desocupado">B8</a>
                                <a href="#!"  data-poltrona="B9"  class="B9 col p-4 m-1 bg-light rounded desocupado">B9</a>
                                <a href="#!"  data-poltrona="B10" class="B10 col p-4 m-1 bg-light rounded desocupado">B10</a>                        
                            </div>
                            <hr class="clearfix">
                            <div class="row">
                                <a href="#!"  data-poltrona="C1"  class="C1 col p-4 m-1 bg-light rounded desocupado">C1</a>
                                <a href="#!"  data-poltrona="C2"  class="C2 col p-4 m-1 bg-light rounded desocupado">C2</a>
                                <a href="#!"  data-poltrona="C3"  class="C3 col p-4 m-1 bg-light rounded desocupado">C3</a>
                                <a href="#!"  data-poltrona="C4"  class="C4 col p-4 m-1 bg-light rounded desocupado">C4</a>
                                <a href="#!"  data-poltrona="C5"  class="C5 col p-4 m-1 bg-light rounded desocupado">C5</a>
                                <a href="#!"  data-poltrona="C6"  class="C6 col p-4 m-1 bg-light rounded desocupado">C6</a>
                                <a href="#!"  data-poltrona="C7"  class="C7 col p-4 m-1 bg-light rounded desocupado">C7</a>
                                <a href="#!"  data-poltrona="C8"  class="C8 col p-4 m-1 bg-light rounded desocupado">C8</a>
                                <a href="#!"  data-poltrona="C9"  class="C9 col p-4 m-1 bg-light rounded desocupado">C9</a>
                                <a href="#!"  data-poltrona="C10" class="C10 col p-4 m-1 bg-light rounded desocupado">C10</a>                        
                            </div>
                            <hr class="clearfix">
                            <div class="row">
                                <a href="#!" data-poltrona="D1"  class="D1 col p-4 m-1 bg-light rounded desocupado">D1</a>
                                <a href="#!" data-poltrona="D2"  class="D2 col p-4 m-1 bg-light rounded desocupado">D2</a>
                                <a href="#!" data-poltrona="D3"  class="D3 col p-4 m-1 bg-light rounded desocupado">D3</a>
                                <a href="#!" data-poltrona="D4"  class="D4 col p-4 m-1 bg-light rounded desocupado">D4</a>
                                <a href="#!" data-poltrona="D5"  class="D5 col p-4 m-1 bg-light rounded desocupado">D5</a>
                                <a href="#!" data-poltrona="D6"  class="D6 col p-4 m-1 bg-light rounded desocupado">D6</a>
                                <a href="#!" data-poltrona="D7"  class="D7 col p-4 m-1 bg-light rounded desocupado">D7</a>
                                <a href="#!" data-poltrona="D8"  class="D8 col p-4 m-1 bg-light rounded desocupado">D8</a>
                                <a href="#!" data-poltrona="D9"  class="D9 col p-4 m-1 bg-light rounded desocupado">D9</a>
                                <a href="#!" data-poltrona="D10" class="D10 col p-4 m-1 bg-light rounded desocupado">D10</a>
                            </div>
                            <hr class="clearfix">
                            <div class="row">
                                <a href="#!" data-poltrona="E1"  class="E1 col p-4 m-1 bg-light rounded desocupado">E1</a>
                                <a href="#!" data-poltrona="E2"  class="E2 col p-4 m-1 bg-light rounded desocupado">E2</a>
                                <a href="#!" data-poltrona="E3"  class="E3 col p-4 m-1 bg-light rounded desocupado">E3</a>
                                <a href="#!" data-poltrona="E4"  class="E4 col p-4 m-1 bg-light rounded desocupado">E4</a>
                                <a href="#!" data-poltrona="E5"  class="E5 col p-4 m-1 bg-light rounded desocupado">E5</a>
                                <a href="#!" data-poltrona="E6"  class="E6 col p-4 m-1 bg-light rounded desocupado">E6</a>
                                <a href="#!" data-poltrona="E7"  class="E7 col p-4 m-1 bg-light rounded desocupado">E7</a>
                                <a href="#!" data-poltrona="E8"  class="E8 col p-4 m-1 bg-light rounded desocupado">E8</a>
                                <a href="#!" data-poltrona="E9"  class="E9 col p-4 m-1 bg-light rounded desocupado">E9</a>
                                <a href="#!" data-poltrona="E10" class="E10 col p-4 m-1 bg-light rounded desocupado">E10</a>
                            </div>                            
                        </div>
                    </div>
                </div>

                <!-- Formulário de Espetáculos - Edit -->
                <div class="modal fade" id="espetaculoModalEdit-<?=$espetaculo['id']?>" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Espetáculo</h5>
                                <button type="button" class="close" data-dismiss="modal" >
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/espetaculo/update" method="post" id="espetaculoFormEdit-<?=$espetaculo['id']?>" class="espetaculosForms" >
                                    <input name="id" type="hidden" value="<?=$espetaculo['id']?>" >
                                    <div class="form-group">
                                        <input class="form-control" name="titulo" id="edit-espetaculo-titulo" value="<?=$espetaculo['titulo']?>" placeholder="Titulo">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control decimal" name="valor" id="edit-espetaculo-valor" value="<?=number_format($espetaculo['valor'],2,',','.')?>" placeholder="Valor">
                                    </div>
                                    <button class="btn btn-block btn-dark" type="submit">Salvar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php $contador++ ?>
                <?php } ?>

            </div>
        </section>

        </div>

        <!-- Formulário de Espetáculos - Add -->
        <div class="modal fade" id="espetaculoModalAdd" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar Espetáculo</h5>
                        <button type="button" class="close" data-dismiss="modal" >
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/espetaculo/add" method="post" id="espetaculoFormAdd" class="espetaculosForms">
                            <div class="form-group">
                                <input class="form-control" name="titulo" id="add-espetaculo-titulo" value="" placeholder="Titulo">
                            </div>
                            <div class="form-group">
                                <input class="form-control decimal" name="valor" id="add-espetaculo-valor" value="" placeholder="Valor">
                            </div>
                            <button class="btn btn-block btn-dark" type="submit">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>        

    </main>
    <script src="/assets/mascaras.js"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
    $(function(){

        var poltronasTotal = $("#poltronasContent").data('poltronas-total');
        var poltronasJson  = $("#poltronasContent").data('poltronas-json');
        
        $(".decimal").on("keyup",function(){
            mascara(this, mvalor);
        })

        $(".alert--flash").show( 300 ).delay( 2500 ).slideUp( 400 )

        $(".espetaculosForms").on('submit', function(event){
            
            var id = $(this).attr('id');

            if( !$('#' + id +' input[name=titulo]').val().length ){
                alert("Informe o Titulo");
                return false;
            }

            if( !$('#' + id +' input[name=valor]').val().length ){
                alert("Informe o Valor");
                return false;
            }

        })

        $('.buttonDelete').on('click',function()
        {            
            event.preventDefault();

            var id = $(this).data('id');
            
            if( confirm('Deseja deletar o espetaculo #' + id + '?') ){
                location = '/espetaculo/delete/' + id;
            }
        })

        var tooglePoltrona = function(element)
        {            
            if( element.hasClass('bg-light') ){
                element.removeClass('bg-light').addClass("bg-secondary");
                element.removeClass('desocupado').addClass("ocupado");
            } 
            else{
                element.removeClass('bg-secondary').addClass("bg-light");
                element.removeClass('ocupado').addClass("desocupado");
            }            
        }

        $(".poltronasGrid a").on("click", function(event)
        {    
            event.preventDefault();
            
            var poltrona   = $(this);
            var codigo     = poltrona.data("poltrona");
            var espetaculo = $(this).parents(".poltronasGrid").data('espetaculo');            

            if(poltrona.hasClass('desocupado')){

                $.post("/poltrona/insertAjax/" + espetaculo + "/" + codigo, function(data){
                    alert(data[1])
                    tooglePoltrona(poltrona);                    
                },"json")

            } else if( poltrona.hasClass('ocupado')){

                $.post("/poltrona/deleteAjax/" + espetaculo + "/" + codigo, function(data){
                    alert(data[1])
                    tooglePoltrona(poltrona);
                },"json")
            }

            refreshCountPoltronas();

        })

        var countPoltronas = function(espetaculo)
        {                        
            $('#espetaculo-' + espetaculo.id + ' .poltronasReservadas > span').text(espetaculo.totalOcupadas);
            $('#espetaculo-' + espetaculo.id + ' .poltronasDisponiveis > span').text(poltronasTotal - espetaculo.totalOcupadas);
            
            $('#poltronas-'  + espetaculo.id + ' .valorTotal > span').text(espetaculo.valorTotal);
        }

        var refreshCountPoltronas = function(){
            $.post('/dashboard/refreshJson', function(json){
                for(index in json.poltronas){
                    var espetaculo = json.poltronas[index];
                    countPoltronas(espetaculo);
                }
            },'json')
        }

        var setPoltronasOcupada = function(poltrona)
        {
            poltrona.removeClass('bg-light').addClass("bg-secondary");
            poltrona.removeClass('desocupado').addClass("ocupado");                    
        }

        var loadPoltronas = function()
        {                        
            for(poltronaIndex in poltronasJson.poltronas){
                
                var espetaculo = poltronasJson.poltronas[poltronaIndex];
                var ocupadas   = espetaculo.ocupadas.split(',');

                for( ocupadasIndex in ocupadas ){
                    var codigo   = ocupadas[ocupadasIndex];
                    var poltrona = $( '#poltronas-' + espetaculo.id + ' .poltronasGrid .' + codigo );
                    setPoltronasOcupada(poltrona);
                };

                countPoltronas(espetaculo);
            }
        }
        loadPoltronas();


    })
    </script>
</body>
</html>