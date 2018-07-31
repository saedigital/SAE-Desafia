<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Atualizar informações do Espetáculo <?= $e['nomeEspetaculo'] ?></h2>
        </div>
        <div class="row">
            <div class="formulario col-md-12">
                <form name="cadastraEspetaculo" method="post" action="<?= base_url()?>home/atualizarEspetaculo/<?= $e['idEspetaculo'] ?>">
                <div class="form-group has-default bmd-form-group">
                    <input type="text" name="nomeEspetaculo" class="form-control" placeholder="Nome do Espetaculo" value="<?= $e['nomeEspetaculo'] ?>">
                </div>
                <div class="form-group has-default bmd-form-group col-sm-2">
                    <label class="label-control">Quantidade de Lugares</label>
                    <input type="text" name="numPoltronas" class="form-control" placeholder="Quantidade de Lugares" maxlength="4" width="4" value="<?= $e['numPoltronas'] ?>">
                </div>
                <div class="form-group">
                    <label class="label-control">Data do Espetaculo</label>
                    <input type="text" name="dataEspetaculo" class="form-control datetimepicker col-sm-4" value="<?= $e['dataEspetaculo'] ?>" maxlength="12" width="12"/>
                </div>
                <p style="text-align:center;"><input type="submit" class="btn btn-success btn-round" value="Atualizar Cadastro"></p>
                </form>
            </div>

            <br />
        </div>
    </div>
</div>
</div>
