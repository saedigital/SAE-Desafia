<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><i class="fa fa-home"></i> Home</li>
        </ol>
    </nav>
</div>
<div class="offset-2 col-8">
    <div class="text-right" style="margin-bottom: 20px">
        <a href="/espetaculo/novo" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Espetáculo</a>
        <a href="/configurar" class="btn btn-primary"><i class="fa fa-cog"></i> Configurar</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Lista de Espetáculos</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 35%;">Nome do Evento</th>
                    <th scope="col" style="width: 35%">Local</th>
                    <th scope="col" style="width: 10%;">Disponíveis</th>
                    <th scope="col" style="width: 10%;">Reservados</th>
                    <th scope="col" style="width: 130px;" class="text-center"><i class="fa fa-cogs"></i></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($espetaculos as $row): ?>
                    <tr>
                        <td><?php echo $row['chrEspetaculo']; ?></td>
                        <td><?php echo $row['chrLocal']; ?></td>
                        <td><?php echo $row['poltronas'] - $row['reservas']; ?></td>
                        <td><?php echo $row['reservas']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="/espetaculo/editar/<?php echo $row['id']; ?>" class="btn btn-primary"><i
                                            class="fa fa-edit"></i></a>
                                <a href="/espetaculo/<?php echo $row['id']; ?>/reservas" class="btn btn-success"><i
                                            class="fa fa-calendar"></i></a>
                                <a href="/espetaculo/remover/<?php echo $row['id']; ?>"
                                   class="btn btn-danger rm-event"><i class="fa fa-times"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
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

            var evento = $btn.closest('tr').find('td').first().html();
            if(!confirm('Deseja excluir o espetaculo "' + evento +  '"?'))
                return;

            var url = $btn.attr('href');
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