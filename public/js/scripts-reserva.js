/**
 * Scripts utilizado para as realizar as reservas das poltronas
 * Criado em janeiro/2018 
 * @author: Ander
 */

var cart;

/**
 * Selecionar / Remover poltronas
 */
$(document).ready(function () {
    cart = $('#selected-seats');
    var counter = $('#counter');
    var total = $('#total');

    var price = $('#valor_poltrona').val();

    var sc = $('#seat-map').seatCharts({
        map: [
            'aaaaaaaaaa',
            'aaaaaaaaaa'
        ],
        naming: {
            top: false,
            getLabel: function (character, row, column) {
                return column;
            }
        },
        legend: {
            node: $('#legend'),
            items: [
                ['a', 'available', 'Livre'],
                ['a', 'unavailable', 'Reservado']
            ]
        },
        click: function () {
            if (this.status() == 'available') {

                $('<option selected>' + (this.settings.row + 1) + '_' + this.settings.label + '</option>')
                        .attr('id', 'cart-item-' + this.settings.id)
                        .attr('value', this.settings.id)
                        .attr('alt', price)
                        .data('seatId', this.settings.id)
                        .appendTo(cart);

                counter.text(sc.find('selected').length + 1);
                counter.attr('value', sc.find('selected').length + 1);

                total.text(recalculateTotal(sc));
                total.attr('value', recalculateTotal(sc));

                return 'selected';

            } else if (this.status() == 'selected') {
                counter.text(sc.find('selected').length - 1);
                counter.attr('value', sc.find('selected').length - 1);

                $('#cart-item-' + this.settings.id).remove();

                total.text(recalculateTotal(sc));
                total.attr('value', recalculateTotal(sc));

                return 'available';

            } else if (this.status() == 'unavailable') {
                return 'unavailable';

            } else {
                return this.style();
            }
        }
    });
});

/**
 * Função para formatar número
 * @param {int} number = Número
 * @param {int} decimals = número de casas decimais
 * @param {caracter} decPoint = Separador decimal
 * @param {caracter} thousandsSep = Separador de milhar
 * @returns {unresolved}
 */
function number_format(number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''
    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k).toFixed(prec)
    }
    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }
    return s.join(dec)
}

/**
 * Função para recalcular o total
 * @param {var} sc = seatCharts
 * @returns {float} = Número 
 */
function recalculateTotal(sc) {
    var total = 0;
    $('#selected-seats').find('option:selected').each(function () {
        total += Number($(this).attr('alt'));
    });

    return number_format(total, 2, ',', '.');
}

/**
 * Reservar poltronas
 */
$(document).ready(function () {
    $(document).on('click', '.reservar', function () {

        var id_espetaculo = getUrlVars()["id"];

        var sel_poltronas = $.map($("#selected-seats option"), function (a) {
            return a.value;
        }).join(';');

        $(".resultado").show();
        if (!sel_poltronas) {
            $(".resultado").html('<div class="alert alert-warning">Nenhuma poltrona selecionada.</div>').fadeOut(3000);
            return;
        }

        $.ajax({
            url: 'config/action_reserva.php',
            type: 'POST',
            data: {
                acao: 'reservar',
                id: id_espetaculo,
                sel_poltronas: sel_poltronas
            },
            success: function (data)
            {
                if (data > 0) {
                    $(".resultado").html('<div class="alert alert-success">Reservado com sucesso! Aguarde para atualizar.</div>').fadeOut(5000);
                    window.setTimeout(function () {
                        location.reload()
                    }, 2000)
                } else {
                    $(".resultado").html('<div class="alert alert-danger">Erro ao reservar.</div>').fadeOut(3000);
                }
            }
        });
        return false;
    });
});

/**
 * Remover reserva de poltrona - página do espetáculo
 */
$(document).ready(function () {
    $(document).on('click', '.deletar', function () {
        var id = $(this).data('id');

        $.ajax({
            url: 'config/action_reserva.php',
            type: 'POST',
            data: {
                acao: 'deletar',
                id: id
            },
            success: function (data)
            {
                if (data == 1) {
                    $('#tr_' + id).fadeOut('slow');
                }
            }
        });
        return false;
    });
});

/**
 * Remover reserva - Página detalhes da reserva
 */
$(document).ready(function () {
    $(document).on('click', '.remover', function () {
        var id_reserva = $(this).data('id');

        $.ajax({
            url: 'config/action_reserva.php',
            type: 'POST',
            data: {
                acao: 'removereserva',
                id_reserva: id_reserva
            },
            success: function (data)
            {
                if (data == 1) {
                    $('#tr_' + id_reserva).fadeOut('slow');
                    window.setTimeout(function () {
                        location.reload()
                    }, 1000)
                }
            }
        });
        return false;
    });
});

/**
 * Mostrar reserva de poltrona - Página detalhes da reserva
 */
$(document).ready(function () {
    $(document).on('click', '#btn-detalhe', function () {
        var id_reserva = $(this).data('id');

        $('#dynamic-content').html('');

        $("h4.modal-title").text("Número da reserva: " + id_reserva);

        $.ajax({
            url: 'config/action_reserva.php',
            type: 'POST',
            data: {
                acao: 'mostrapoltronas',
                id_reserva: id_reserva
            },
            success: function (data)
            {
                $('#dynamic-content').html('');
                $('#dynamic-content').html(data);
            }
        });
        return false;
    });
});


/**
 * Atualizar a página após fechar janela modal
 */
$(document).ready(function () {
    $('#cancelar-reserva').on('hidden.bs.modal', function () {
        location.reload();
    });
});

/**
 * Função para pegar o id via GET corretamente
 * @returns {var}
 */
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&#]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}