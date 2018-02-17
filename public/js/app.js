$(document).ready(function () {
    $('.seat').click(function () {
        if (!$(this).hasClass('unclickable')) {
            var id = $(this).attr('id');
            $(this).toggleClass('selected');

            refreshSelectedSeats();
        }
    });

    $('#btn-action').click(function () {
        var email = $('#email').val();
        var eventId = $('#eventId').val();
        var seats = [];

        $.each($('.selected'), function (i, item) {
            var id = $(item).attr('id').replace('seat-', '');
            seats.push(id);
        });

        if (email.length > 0) {
            $.ajax({
                url: '/async-seat-pick',
                method: 'post',
                data: {
                    eventId: eventId,
                    email: email,
                    seats: seats
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, errorMessage) {
                    console.log(xhr);
                    console.log(errorMessage);
                }
            });
        }

        return false;
    });

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
    });

});

function refreshSelectedSeats() {
    $('.seats-selected').html('');
    $.each($('.selected'), function (i, item) {
        var id = $(item).attr('id').replace('seat-', '');
        var content = 'Poltrona ' + id;

        if ($(item).hasClass('admin-managing')) {
            content += ' <a href="#" ';
            content += 'class="btn btn-danger btn-sm btn-cancel-reservation" rel="' + id + '"';
            content += '">Cancelar reserva</a>';
        }
        $('.seats-selected').append(content + '<br/>');
    });
}