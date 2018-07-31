<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Reserva</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="espetaculo">
                    <h2><?= $e['nomeEspetaculo']; ?></h2>
                    <p>Data do evento: <?= $e['dataEspetaculo'] ?></p>
                    <p>Numero de lugares: <?= $e['numPoltronas'] ?></p>
                    <p>Lugares disponíveis: <?= ($e['numPoltronas'] - $e['numReservas']) ?></p>
                    <p class="text-success">Valor: <b>R$: 23,76</b></p>
                    <?php if ($acao == 0) { ?>
                        <div class="alert alert-warning" style="margin-bottom: 20px !important;">
                            <div class="container">
                                <div class="alert-icon">
                                    <i class="material-icons">warning</i>
                                </div>
                                <?= $msg ?>
                            </div>
                        </div>
                        <br />
                    <?php } ?> 
                </div>
            </div>
            <div class="formulario col-md-8">
                <form name="confirmaReserva" method="post" action="<?= base_url()?>home/confirmaReserva">
                <div class="form-group has-default bmd-form-group">
                    <input type="text" name="nomeCliente" class="form-control" placeholder="Nome">
                </div>
                    <input type="hidden" name="idEspetaculo" value="<?= $e['idEspetaculo']?>">
                    <input type="hidden" name="numReservas" value="<?= $e['numReservas']?>">
                <p style="text-align:center;"><input type="submit" class="btn btn-success btn-round" value="Confirmar Reserva"></p>
                </form>
            </div>

            <br />
        </div>
    </div>
</div>
</div>
