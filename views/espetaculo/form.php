<?php
/**
 * @var $localCollection array
 * @var $title string
 */
?>
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title;?></li>
        </ol>
    </nav>
</div>
<div class="offset-2 col-8">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><?php echo $title;?></h3>
        </div>
        <?php
        if($localCollection):
            require 'form-content.php';
        else:
        ?>
        <div class="card-body">

            <div class="text-danger text-center">
                <h3>Não existem locais cadastrados</h3>
                <p>Para criar espetáculos é necessário configurar um local e suas respectivas poltronas.</p>
                <a href="/local/novo" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Local</a>
            </div>
        <?php endif;?>
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
                window.location.href = '/';
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