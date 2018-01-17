var price = 23.76;

$(document).ready(function () {
    var $cart = $('#selected-seats'),
            $counter = $('#counter'),
            $total = $('#total');

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
                $('<li>' + (this.settings.row + 1) + '_' + this.settings.label + '</li>')
                        .attr('id', 'cart-item-' + this.settings.id)
                        .data('seatId', this.settings.id)
                        .appendTo($cart);

                $counter.text(sc.find('selected').length + 1);
                $total.text(recalcularTotal(sc) + price);
                return 'selected';
                
            } else if (this.status() == 'selected') {
                $counter.text(sc.find('selected').length - 1);
                $total.text(recalcularTotal(sc) - price);
                $('#cart-item-' + this.settings.id).remove();
                return 'available';
                
            } else if (this.status() == 'unavailable') {
                return 'unavailable';
                
            } else {
                return this.style();
            }
        }
    });
});

function recalcularTotal(sc) {
    var total = 0;
    sc.find('selected').each(function () {
        total += price;
    });

    return total;
}
