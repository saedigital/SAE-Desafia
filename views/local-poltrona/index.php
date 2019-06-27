<?php
/**
 * @var $collection array
 */
?>
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="/configurar"><i class="fa fa-cog"></i> Configurar</a></li>
            <li class="breadcrumb-item"><a href="/local"><i class="fa fa-map-marker"></i> Locais</a></li>
            <li class="breadcrumb-item active">Poltronas</li>
        </ol>
    </nav>
</div>
<div class="offset-2 col-8">
    <div class="text-right" style="margin-bottom: 20px">
        <a href="/local/<?php echo $fkLocal;?>/poltrona/novo" class="btn btn-primary"><i class="fa fa-plus"></i> Nova Poltrona</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><i class="fa fa-map-marker"></i> Poltronas</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 100%;">Código</th>
                    <th scope="col" style="width: 90px;" class="text-center"><i class="fa fa-cogs"></i> </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($collection as $row):?>
                    <tr>
                        <td><?php echo $row['chrCodigo']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo "/local/$fkLocal/poltrona/editar/{$row['id']}"; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="<?php echo "/local/$fkLocal/poltrona/excluir/{$row['id']}"; ?>" class="btn btn-danger rm-event"><i class="fa fa-times"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var rmEvent = function(e) {
            e.preventDefault();
            var $btn = $(this);
            var url = $btn.attr('href');
            var codigo = $btn.closest('tr').find('td').first().html();
            if(!confirm('Deseja excluir a poltrona "' + codigo + '"?'))
                return;

            $.getJSON(url, function (data) {
                if(!data.success)
                    return;

                $btn.closest('tr').remove();
            });

        };

        $('.btn.rm-event').each(function () {
            $(this).click(rmEvent);
        });

    });

</script>