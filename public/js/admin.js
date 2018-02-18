jQuery(document).ready(function ($) {
    $('.delete-link').click(function () {
        var id = $(this).attr('rel');
        if (confirm('Deseja realmente remover?')) {
            $('#delete-' + id).click();
        }
        return false;
    });

    $(document).delegate('.btn-cancel-reservation', 'click', function () {
        if (confirm('Deseja realmente cancelar esta reserva?')) {
            var seatNumber = $(this).attr('rel');
            var eventId = $('#eventId').val();

            $.ajax({
                url: '/admin/async-seat-cancel',
                method: 'post',
                data: {
                    eventId: eventId,
                    seatNumber: seatNumber
                },
                success: function (response) {
                    console.log(response);
                    if (response.statusCode === 200) {
                        var seat = $('#seat-' + seatNumber);
                        $(seat).removeClass('pre-reserved');
                        $(seat).removeClass('unavailable');
                        $(seat).removeClass('selected');
                        $(seat).addClass('unclickable');

                        var activeCount = parseInt($('.active-count').text());
                        activeCount--;
                        $('.active-count').text(activeCount);

                        refreshSelectedSeats();
                    }
                },
                error: function (xhr, errorMessage) {
                    console.log(xhr);
                    console.log(errorMessage);
                }
            });
        }

        return false;
    })
        .delegate('.price', 'focus', function () {
            $(this).priceFormat({
                prefix: 'R$ ',
                centsSeparator: ',',
                thousandsSeparator: '.'
            });
        });

    $.datetimepicker.setLocale('pt');
    $('.datetimepicker').datetimepicker({
        i18n:{
            pt:{
                months:[
                    'Janeiro','Fevereiro','Março','Abril',
                    'Maio','Junho','Julho','Agosto',
                    'Setembro','Outubro','Novembro','Dezembro'
                ],
                dayOfWeek:[
                    "Dom", "Seg", "Ter", "Qua",
                    "Qui", "Sex", "Sab"
                ]
            }
        },
        format:'d/m/Y H:i',
        minDate: new Date(),
        step: 15
    });
});