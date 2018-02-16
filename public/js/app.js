$(document).ready(function () {
    $('.seat').click(function () {
        var id = $(this).attr('id');
        $(this).toggleClass('selected');

        refreshSelectedSeats();
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

});

function refreshSelectedSeats() {
    $('.seats-selected').html('');
    $.each($('.selected'), function (i, item) {
        var id = $(item).attr('id').replace('seat-', '');
        $('.seats-selected').append('Poltrona ' + id + '<br/>');
    });
}