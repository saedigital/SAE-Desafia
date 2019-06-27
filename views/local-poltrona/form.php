<?php
/**
 * @var $model \App\Model\PoltronaPoltronaModel
 */
$fkLocal = $model->getFkLocal();
$parentRoute = "/local/$fkLocal/poltronas";
?>
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="/configurar"><i class="fa fa-cog"></i> Configurar</a></li>
            <li class="breadcrumb-item"><a href="/local"><i class="fa fa-map-marker"></i> Locais</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $parentRoute;?>">Poltronas</a></li>
            <li class="breadcrumb-item active"><?php echo $title;?></li>
        </ol>
    </nav>
</div>
<div class="offset-2 col-8">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><?php echo $title;?></h3>
        </div>
        <form class="ajax-form" method="post" action="<?php echo $action;?>" novalidate="novalidate">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-4 control-label col-form-label text-right" for="field-chrCodigo">Poltrona</label>
                    <div class="col-5">
                        <input type="text" class="form-control" id="field-chrCodigo" name="chrCodigo"
                               placeholder="BLOCO B - D12" value="<?php echo $model->getChrCodigo();?>">
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
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ajax-form select').each(function () {
            var $me = $(this);
            $me.val($me.attr('value'));
        });
        $('.ajax-form').submit(function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var params = {};
            $(this).serializeArray().map(function (row) {
                params[row.name] = row.value;
            });
            var success = function() {
                window.location.href = '<?php echo $parentRoute;?>';
            };

            var setFieldError = function (k, message) {
                var $field = $('[name=' + k  + ']');
                var $message = $field.closest('.form-group').find('.invalid-feedback');
                console.log($message.length)
                $message.html(message);
                $field.toggleClass('is-invalid', message.length);
            };

            $.post(url, params, success)
                .fail(function (jqXHR, textStatus, errorThrown) {
                   if(!jqXHR.responseJSON)
                       return;

                    $.each(jqXHR.responseJSON.errors, setFieldError);
                });
        })
    });
</script>