<?php
/**
 * @var $collection array
 * @var $evento \App\Model\EspetaculoModel
 */

?>
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Reservas do Evento <?php $evento->getChrEspetaculo() ?></li>
        </ol>
    </nav>
</div>
<div class="offset-2 col-8">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Reservas do Evento <?php $evento->getChrEspetaculo() ?></h3>
        </div>
        <div class="card-body">
            <ul>
                <li>Disponíveis: <span id="total_disponivel"><?php echo $status['poltronas'] - $status['reservas'];?></span></li>
                <li>Reservados: <span id="total_reservado"><?php echo $status['reservas'];?></span></li>
            </ul>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 75%;">Poltrona</th>
                    <th scope="col" style="width: 140px;"  class="text-center"><i class="fa fa-cogs"></i> </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($collection as $row):?>
                    <?php
                        $btn = 'mark-event btn btn-' . ($row['disponivel'] ? 'success' : 'danger');
                        $ico = 'fa fa-' . ($row['disponivel'] ? 'check' : 'times');
                        $txt = $row['disponivel'] ? 'Reservar' : 'Desistir';
                        $url = "/espetaculo/$id/reserva/{$row['id']}"
                    ?>
                    <tr>
                        <td><?php echo $row['chrCodigo']; ?></td>
                        <td>
                            <div class="btn-group">
                                <?php echo "<a href=\"$url\" class=\"$btn\"><i class=\"$ico\"></i> &nbsp;<span>$txt</span></a>";?>
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
        var markEvent = function (e) {
            e.preventDefault();
            var $btn = $(this);
            var url = $btn.attr('href');
            $.getJSON(url, function (data) {
                marked($btn, data.mark);
                $('#total_disponivel').html(data.poltronas - data.reservas);
                $('#total_reservado').html(data.reservas);
            });
        };

        var marked = function($btn, isMark) {
            var $ico = $btn.find('i.fa');
            var $txt = $btn.find('span');
            $ico.toggleClass('fa-times', isMark).toggleClass('fa-check', !isMark);
            $btn.toggleClass('btn-danger', isMark).toggleClass('btn-success', !isMark);
            $txt.html(isMark ? 'Desistir' : 'Reservar');

        };

        $('.btn.mark-event').each(function () {
            $(this).click(markEvent);
        });
    });
</script>