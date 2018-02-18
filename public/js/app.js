jQuery(document).ready(function ($) {
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
                    if (response.statusCode === 201) {
                        $('.success-message').removeClass('hidden');
                        setTimeout(function () {
                            window.location.href = response.data.url;
                        }, 1000 * 10);
                    } else {
                        $('.error-message-content').html(response.message);
                        $('.error-message').removeClass('hidden');
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
    var ticketAmount = parseFloat($('#ticketAmount').val());
    var selectedCount = 0;
    $.each($('.selected'), function (i, item) {
        var id = $(item).attr('id').replace('seat-', '');
        var content = 'Poltrona ' + id;

        if ($(item).hasClass('admin-managing')) {
            content += ' <a href="#" ';
            content += 'class="btn btn-danger btn-sm btn-cancel-reservation" rel="' + id + '"';
            content += '">Cancelar reserva</a>';
        }
        $('.seats-selected').append(content + '<br/>');
        selectedCount++;
    });

    if (selectedCount > 0) {
        var total = parseFloat(ticketAmount * selectedCount).toFixed(2).toString();
        $('#orderAmount').text(total.replace('.', ','));
    } else {
        $('#orderAmount').text('0,00');
    }
}