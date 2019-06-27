<?php
/**
 * @var $model \App\Model\EspetaculoModel
 * @var $localCollection array
 * @var $action string
 */
?>
<form class="ajax-form" method="post" action="<?php echo $action;?>" novalidate="novalidate">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-4 control-label col-form-label text-right" for="field-fkLocal">Local</label>
            <div class="col-5">
                <select  class="form-control" id="field-fkLocal" name="fkLocal" value="<?php echo $model->getFkLocal();?>">
                    <option value="">Selecione uma opção.</option>
                    <?php
                    foreach($localCollection as $id=>$label)
                        echo  "<option value=\"$id\">$label</option>";
                    ?>
                </select>
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4 control-label col-form-label text-right" for="field-chrEspetaculo">Nome do Evento</label>
            <div class="col-5">
                <input type="text" class="form-control" id="field-chrEspetaculo" name="chrEspetaculo"
                       placeholder="Ipsum Loren Party" value="<?php echo $model->getChrEspetaculo();?>">
                <div class="invalid-feedback"></div>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="form-group row">
            <div class="col-9 col-offset-4">
                <button type="submit" class="btn btn-primary pull-right" value="Sign up">
                    <i class="fa fa-floppy-o"></i>
                    Salvar
                </button>
            </div>
        </div>
    </div>
</form>