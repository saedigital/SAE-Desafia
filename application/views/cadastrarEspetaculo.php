<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Reserva</h2>
        </div>
        <div class="row">
            <div class="formulario col-md-12">
                <form name="cadastraEspetaculo" method="post" action="<?= base_url()?>home/gravaEspetaculo">
                <div class="form-group has-default bmd-form-group">
                    <input type="text" name="nomeEspetaculo" class="form-control" placeholder="Nome do Espetaculo">
                </div>
                <div class="form-group has-default bmd-form-group col-sm-2">
                    <input type="text" name="numPoltronas" class="form-control" placeholder="Quantidade de Lugares" maxlength="4" width="4">
                </div>
                <div class="form-group">
                    <label class="label-control">Data do Espetaculo</label>
                    <input type="text" name="dataEspetaculo" class="form-control datetimepicker col-sm-4" value="<?php echo date("Y-m-d"); ?>" maxlength="12" width="12"/>
                </div>
                <p style="text-align:center;"><input type="submit" class="btn btn-success btn-round" value="Confirmar Cadastro"></p>
                </form>
            </div>

            <br />
        </div>
    </div>
</div>
</div>
