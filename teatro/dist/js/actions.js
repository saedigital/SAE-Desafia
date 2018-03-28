var espetaculo = 0;
var espetaculos = new Object;

$(document).on('click', '.js-cadastrar', function(e){
    e.preventDefault();

    $('.modal--cadastro').fadeIn();
});

$(document).on('click', '.ge-modal__fechar', function(e){
    e.preventDefault();

    $('.ge-modal').fadeOut();
    $('.alerta').hide();
});


$(document).on('click', '.ge-modal__cadastrar', function(e){
    e.preventDefault();

    var nome = $(this).siblings('input[name=nome]').val();
    var poltronas = parseInt($(this).siblings('input[name=poltronas]').val());
    var reservadas = 0;
    var arrecadacao = '0,00';

    if(nome=='' && poltronas==''){
        $('.alerta').html('Por gentileza, preencha todos os campos').show();
        return false;
    }

    espetaculo++;

    espetaculos[espetaculo] = [];

    var template = `
        <li class="espetaculo" data-espetaculo="${espetaculo}" data-poltronas="${poltronas}">
            <h3 class="ge-main__container-espetaculos__espetaculo">${nome}</h3>
            <button class="ge-main__espetaculo__button js-reservar">Reservar Poltrona</button>
            <span class="ge-main__container-espetaculos__disponiveis">Locais disponíveis: <strong>${poltronas}</strong></span>
            <span class="ge-main__container-espetaculos__reservados">Locais reservados: <strong>${reservadas}</strong></span>
            <span class="ge-main__container-espetaculos__arrecadacao">Arrecadação: R$<strong>${arrecadacao}</strong></span>
            <ul class="ge-main__container-espetaculos__espetaculo__actions">
                <li class="js-editar"><a href="editar">Editar</a></li>
                <li class="js-remover"><a href="remover">Remover</a></li>
                <li class="js-ver"><a href="ver">Ver</a></li>
            </ul>
        </li>
    `;
    
    $('.ge-main__container-espetaculos__list').append(template);

    $('.modal--cadastro').fadeOut();

    $('.alerta').hide();
    $('input[name=nome]').val('');
    $('input[name=poltronas]').val('');
});

$(document).on('click', '.js-editar', function(e){
    e.preventDefault();

    var nome = $(this).parent().siblings('.ge-main__container-espetaculos__espetaculo').html();
    var poltronas = $(this).parents('li').attr('data-poltronas');
    var espetaculo = $(this).parents('li').attr('data-espetaculo');

    $('.modal--editar input[name=nome]').val(nome);
    $('.modal--editar input[name=poltronas]').val(poltronas);
    $('.modal--editar').attr('data-espetaculo', espetaculo);
    $('.modal--editar').attr('data-poltronas', poltronas);
    $('.modal--editar').fadeIn();
});

$(document).on('click', '.ge-modal__editar', function(e){
    e.preventDefault();

    var nome = $(this).siblings('input[name=nome]').val();
    var poltronas = parseInt($(this).siblings('input[name=poltronas]').val());
    var poltronas_atual = $(this).parents('.modal--editar').attr('data-poltronas');
    var espetaculo = $(this).parents('.modal--editar').attr('data-espetaculo');

    if(nome=='' && poltronas==''){
        $('.alerta').html('Por gentileza, preencha todos os campos').show();
        return false;
    }

    if(espetaculos[espetaculo].length > poltronas){
        $('.alerta').html('Há mais reservas que o número de poltronas definido').show();
        return false;
    }

    var disponiveis = parseInt(poltronas) - parseInt(espetaculos[espetaculo].length);

    $('.espetaculo[data-espetaculo='+espetaculo+']').attr('data-poltronas', poltronas);
    $('.espetaculo[data-espetaculo='+espetaculo+'] .ge-main__container-espetaculos__espetaculo').html(nome);
    $('.espetaculo[data-espetaculo='+espetaculo+'] .ge-main__container-espetaculos__disponiveis strong').html(disponiveis);
    $('.espetaculo[data-espetaculo='+espetaculo+'] .ge-main__container-espetaculos__reservados strong').html(espetaculos[espetaculo].length);

    $('.modal--editar').fadeOut();

    $('.alerta').hide();
    $('input[name=nome]').val('');
    $('input[name=poltronas]').val('');
});



$(document).on('click', '.js-remover', function(e){
    e.preventDefault();

    $(this).parents('li').remove();
});


$(document).on('click', '.js-reservar', function(e){
    e.preventDefault();
    var espetaculo = $(this).parents('li').attr('data-espetaculo');
    var poltronas = parseInt($(this).parents('li').attr('data-poltronas'));

    $('.modal--reserva').attr('data-espetaculo', espetaculo).attr('data-poltronas', poltronas).fadeIn();
});

$(document).on('click', '.ge-modal__reservar', function(e){
    e.preventDefault();

    var nome = $(this).siblings('input[name=nome]').val();
    var espetaculo = $('.modal--reserva').attr('data-espetaculo');
    var poltronas = $('.modal--reserva').attr('data-poltronas');

    if(nome==''){
        $('.alerta').html('Por gentileza, digite um nome para a reserva').show();
        return false;
    }

    console.log(espetaculos[espetaculo].length +' - '+ poltronas);
    if(espetaculos[espetaculo].length > (poltronas - 1)){
        $('.alerta').html('A reservas estão esgotadas').show();
        return false;
    }

    espetaculos[espetaculo].push(nome);
    espetaculos[espetaculo].sort();
    var total = (parseInt(espetaculos[espetaculo].length)*2376)/100;

    var disponiveis = parseInt(poltronas) - parseInt(espetaculos[espetaculo].length);

    $('.espetaculo[data-espetaculo='+espetaculo+'] .ge-main__container-espetaculos__disponiveis strong').html(disponiveis);
    $('.espetaculo[data-espetaculo='+espetaculo+'] .ge-main__container-espetaculos__reservados strong').html(espetaculos[espetaculo].length);
    $('.espetaculo[data-espetaculo='+espetaculo+'] .ge-main__container-espetaculos__arrecadacao strong').html(total.toFixed(2));

    $('.ge-modal').fadeOut();
    $('.alerta').hide();
    $(this).siblings('input[name=nome]').val('');
});


$(document).on('click', '.js-ver', function(e){
    e.preventDefault();

    var espetaculo = $(this).parents('li').attr('data-espetaculo');
    var poltronas = parseInt($(this).parents('li').attr('data-poltronas'));

    var total = (parseInt(espetaculos[espetaculo].length)*2376)/100;
    total = total.toFixed(2);
    var disponiveis = parseInt(poltronas) - parseInt(espetaculos[espetaculo].length);

    var nome = $(this).parent().siblings('.ge-main__container-espetaculos__espetaculo').html();
    var reservas = '';

    $.each(espetaculos[espetaculo], function(i, item){
        reservas += '<li>'+item+' <button class="ge-main__reserva__cancelar" data-espetaculo="'+espetaculo+'" data-item="'+item+'">Cancelar</button></li>';
    });

    var dados_espetaculo = `
        <h3 class="ge-main__espetaculo__title">${nome}</h3>
        <span class="ge-main__espetaculo__disponiveis">Locais disponíveis: <strong>${disponiveis}</strong></span>
        <span class="ge-main__espetaculo__reservados">Locais reservados: <strong>${espetaculos[espetaculo].length}</strong></span>
        <span class="ge-main__espetaculo__arrecadacao">Arrecadação: R$<strong>${total}</strong></span>

        <ul class="ge-main__espetaculo__reservas">
            ${reservas}
        </ul>
    `;
    
    $('.ge-main__espetaculo').html(dados_espetaculo);
    $('.modal--espetaculo').fadeIn();
});


$(document).on('click', '.ge-main__reserva__cancelar', function(){
    var espetaculo = $(this).attr('data-espetaculo');
    var item = $(this).attr('data-item');
    var poltronas = $('.espetaculo[data-espetaculo='+espetaculo+']').attr('data-poltronas');

    for(var i in espetaculos[espetaculo]){
        if(espetaculos[espetaculo][i]==item){
            espetaculos[espetaculo].splice(i,1);
            break;
        }
    }

    var total = (parseInt(espetaculos[espetaculo].length)*2376)/100;

    var disponiveis = parseInt(poltronas) - parseInt(espetaculos[espetaculo].length);

    $('.espetaculo[data-espetaculo='+espetaculo+'] .ge-main__container-espetaculos__disponiveis strong').html(disponiveis);
    $('.espetaculo[data-espetaculo='+espetaculo+'] .ge-main__container-espetaculos__reservados strong').html(espetaculos[espetaculo].length);
    $('.espetaculo[data-espetaculo='+espetaculo+'] .ge-main__container-espetaculos__arrecadacao strong').html(total.toFixed(2));

    $('.ge-main__espetaculo__disponiveis strong').html(disponiveis);
    $('.ge-main__espetaculo__reservados strong').html(espetaculos[espetaculo].length);
    $('.ge-main__espetaculo__arrecadacao strong').html(total.toFixed(2));

    $(this).parent().remove();
});
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJqcy9hY3Rpb25zLmpzIl0sInNvdXJjZXNDb250ZW50IjpbInZhciBlc3BldGFjdWxvID0gMDtcbnZhciBlc3BldGFjdWxvcyA9IG5ldyBPYmplY3Q7XG5cbiQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcuanMtY2FkYXN0cmFyJywgZnVuY3Rpb24oZSl7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgJCgnLm1vZGFsLS1jYWRhc3RybycpLmZhZGVJbigpO1xufSk7XG5cbiQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcuZ2UtbW9kYWxfX2ZlY2hhcicsIGZ1bmN0aW9uKGUpe1xuICAgIGUucHJldmVudERlZmF1bHQoKTtcblxuICAgICQoJy5nZS1tb2RhbCcpLmZhZGVPdXQoKTtcbiAgICAkKCcuYWxlcnRhJykuaGlkZSgpO1xufSk7XG5cblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5nZS1tb2RhbF9fY2FkYXN0cmFyJywgZnVuY3Rpb24oZSl7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgdmFyIG5vbWUgPSAkKHRoaXMpLnNpYmxpbmdzKCdpbnB1dFtuYW1lPW5vbWVdJykudmFsKCk7XG4gICAgdmFyIHBvbHRyb25hcyA9IHBhcnNlSW50KCQodGhpcykuc2libGluZ3MoJ2lucHV0W25hbWU9cG9sdHJvbmFzXScpLnZhbCgpKTtcbiAgICB2YXIgcmVzZXJ2YWRhcyA9IDA7XG4gICAgdmFyIGFycmVjYWRhY2FvID0gJzAsMDAnO1xuXG4gICAgaWYobm9tZT09JycgJiYgcG9sdHJvbmFzPT0nJyl7XG4gICAgICAgICQoJy5hbGVydGEnKS5odG1sKCdQb3IgZ2VudGlsZXphLCBwcmVlbmNoYSB0b2RvcyBvcyBjYW1wb3MnKS5zaG93KCk7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9XG5cbiAgICBlc3BldGFjdWxvKys7XG5cbiAgICBlc3BldGFjdWxvc1tlc3BldGFjdWxvXSA9IFtdO1xuXG4gICAgdmFyIHRlbXBsYXRlID0gYFxuICAgICAgICA8bGkgY2xhc3M9XCJlc3BldGFjdWxvXCIgZGF0YS1lc3BldGFjdWxvPVwiJHtlc3BldGFjdWxvfVwiIGRhdGEtcG9sdHJvbmFzPVwiJHtwb2x0cm9uYXN9XCI+XG4gICAgICAgICAgICA8aDMgY2xhc3M9XCJnZS1tYWluX19jb250YWluZXItZXNwZXRhY3Vsb3NfX2VzcGV0YWN1bG9cIj4ke25vbWV9PC9oMz5cbiAgICAgICAgICAgIDxidXR0b24gY2xhc3M9XCJnZS1tYWluX19lc3BldGFjdWxvX19idXR0b24ganMtcmVzZXJ2YXJcIj5SZXNlcnZhciBQb2x0cm9uYTwvYnV0dG9uPlxuICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJnZS1tYWluX19jb250YWluZXItZXNwZXRhY3Vsb3NfX2Rpc3Bvbml2ZWlzXCI+TG9jYWlzIGRpc3BvbsOtdmVpczogPHN0cm9uZz4ke3BvbHRyb25hc308L3N0cm9uZz48L3NwYW4+XG4gICAgICAgICAgICA8c3BhbiBjbGFzcz1cImdlLW1haW5fX2NvbnRhaW5lci1lc3BldGFjdWxvc19fcmVzZXJ2YWRvc1wiPkxvY2FpcyByZXNlcnZhZG9zOiA8c3Ryb25nPiR7cmVzZXJ2YWRhc308L3N0cm9uZz48L3NwYW4+XG4gICAgICAgICAgICA8c3BhbiBjbGFzcz1cImdlLW1haW5fX2NvbnRhaW5lci1lc3BldGFjdWxvc19fYXJyZWNhZGFjYW9cIj5BcnJlY2FkYcOnw6NvOiBSJDxzdHJvbmc+JHthcnJlY2FkYWNhb308L3N0cm9uZz48L3NwYW4+XG4gICAgICAgICAgICA8dWwgY2xhc3M9XCJnZS1tYWluX19jb250YWluZXItZXNwZXRhY3Vsb3NfX2VzcGV0YWN1bG9fX2FjdGlvbnNcIj5cbiAgICAgICAgICAgICAgICA8bGkgY2xhc3M9XCJqcy1lZGl0YXJcIj48YSBocmVmPVwiZWRpdGFyXCI+RWRpdGFyPC9hPjwvbGk+XG4gICAgICAgICAgICAgICAgPGxpIGNsYXNzPVwianMtcmVtb3ZlclwiPjxhIGhyZWY9XCJyZW1vdmVyXCI+UmVtb3ZlcjwvYT48L2xpPlxuICAgICAgICAgICAgICAgIDxsaSBjbGFzcz1cImpzLXZlclwiPjxhIGhyZWY9XCJ2ZXJcIj5WZXI8L2E+PC9saT5cbiAgICAgICAgICAgIDwvdWw+XG4gICAgICAgIDwvbGk+XG4gICAgYDtcbiAgICBcbiAgICAkKCcuZ2UtbWFpbl9fY29udGFpbmVyLWVzcGV0YWN1bG9zX19saXN0JykuYXBwZW5kKHRlbXBsYXRlKTtcblxuICAgICQoJy5tb2RhbC0tY2FkYXN0cm8nKS5mYWRlT3V0KCk7XG5cbiAgICAkKCcuYWxlcnRhJykuaGlkZSgpO1xuICAgICQoJ2lucHV0W25hbWU9bm9tZV0nKS52YWwoJycpO1xuICAgICQoJ2lucHV0W25hbWU9cG9sdHJvbmFzXScpLnZhbCgnJyk7XG59KTtcblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5qcy1lZGl0YXInLCBmdW5jdGlvbihlKXtcbiAgICBlLnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICB2YXIgbm9tZSA9ICQodGhpcykucGFyZW50KCkuc2libGluZ3MoJy5nZS1tYWluX19jb250YWluZXItZXNwZXRhY3Vsb3NfX2VzcGV0YWN1bG8nKS5odG1sKCk7XG4gICAgdmFyIHBvbHRyb25hcyA9ICQodGhpcykucGFyZW50cygnbGknKS5hdHRyKCdkYXRhLXBvbHRyb25hcycpO1xuICAgIHZhciBlc3BldGFjdWxvID0gJCh0aGlzKS5wYXJlbnRzKCdsaScpLmF0dHIoJ2RhdGEtZXNwZXRhY3VsbycpO1xuXG4gICAgJCgnLm1vZGFsLS1lZGl0YXIgaW5wdXRbbmFtZT1ub21lXScpLnZhbChub21lKTtcbiAgICAkKCcubW9kYWwtLWVkaXRhciBpbnB1dFtuYW1lPXBvbHRyb25hc10nKS52YWwocG9sdHJvbmFzKTtcbiAgICAkKCcubW9kYWwtLWVkaXRhcicpLmF0dHIoJ2RhdGEtZXNwZXRhY3VsbycsIGVzcGV0YWN1bG8pO1xuICAgICQoJy5tb2RhbC0tZWRpdGFyJykuYXR0cignZGF0YS1wb2x0cm9uYXMnLCBwb2x0cm9uYXMpO1xuICAgICQoJy5tb2RhbC0tZWRpdGFyJykuZmFkZUluKCk7XG59KTtcblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5nZS1tb2RhbF9fZWRpdGFyJywgZnVuY3Rpb24oZSl7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgdmFyIG5vbWUgPSAkKHRoaXMpLnNpYmxpbmdzKCdpbnB1dFtuYW1lPW5vbWVdJykudmFsKCk7XG4gICAgdmFyIHBvbHRyb25hcyA9IHBhcnNlSW50KCQodGhpcykuc2libGluZ3MoJ2lucHV0W25hbWU9cG9sdHJvbmFzXScpLnZhbCgpKTtcbiAgICB2YXIgcG9sdHJvbmFzX2F0dWFsID0gJCh0aGlzKS5wYXJlbnRzKCcubW9kYWwtLWVkaXRhcicpLmF0dHIoJ2RhdGEtcG9sdHJvbmFzJyk7XG4gICAgdmFyIGVzcGV0YWN1bG8gPSAkKHRoaXMpLnBhcmVudHMoJy5tb2RhbC0tZWRpdGFyJykuYXR0cignZGF0YS1lc3BldGFjdWxvJyk7XG5cbiAgICBpZihub21lPT0nJyAmJiBwb2x0cm9uYXM9PScnKXtcbiAgICAgICAgJCgnLmFsZXJ0YScpLmh0bWwoJ1BvciBnZW50aWxlemEsIHByZWVuY2hhIHRvZG9zIG9zIGNhbXBvcycpLnNob3coKTtcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgIH1cblxuICAgIGlmKGVzcGV0YWN1bG9zW2VzcGV0YWN1bG9dLmxlbmd0aCA+IHBvbHRyb25hcyl7XG4gICAgICAgICQoJy5hbGVydGEnKS5odG1sKCdIw6EgbWFpcyByZXNlcnZhcyBxdWUgbyBuw7ptZXJvIGRlIHBvbHRyb25hcyBkZWZpbmlkbycpLnNob3coKTtcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgIH1cblxuICAgIHZhciBkaXNwb25pdmVpcyA9IHBhcnNlSW50KHBvbHRyb25hcykgLSBwYXJzZUludChlc3BldGFjdWxvc1tlc3BldGFjdWxvXS5sZW5ndGgpO1xuXG4gICAgJCgnLmVzcGV0YWN1bG9bZGF0YS1lc3BldGFjdWxvPScrZXNwZXRhY3VsbysnXScpLmF0dHIoJ2RhdGEtcG9sdHJvbmFzJywgcG9sdHJvbmFzKTtcbiAgICAkKCcuZXNwZXRhY3Vsb1tkYXRhLWVzcGV0YWN1bG89Jytlc3BldGFjdWxvKyddIC5nZS1tYWluX19jb250YWluZXItZXNwZXRhY3Vsb3NfX2VzcGV0YWN1bG8nKS5odG1sKG5vbWUpO1xuICAgICQoJy5lc3BldGFjdWxvW2RhdGEtZXNwZXRhY3Vsbz0nK2VzcGV0YWN1bG8rJ10gLmdlLW1haW5fX2NvbnRhaW5lci1lc3BldGFjdWxvc19fZGlzcG9uaXZlaXMgc3Ryb25nJykuaHRtbChkaXNwb25pdmVpcyk7XG4gICAgJCgnLmVzcGV0YWN1bG9bZGF0YS1lc3BldGFjdWxvPScrZXNwZXRhY3VsbysnXSAuZ2UtbWFpbl9fY29udGFpbmVyLWVzcGV0YWN1bG9zX19yZXNlcnZhZG9zIHN0cm9uZycpLmh0bWwoZXNwZXRhY3Vsb3NbZXNwZXRhY3Vsb10ubGVuZ3RoKTtcblxuICAgICQoJy5tb2RhbC0tZWRpdGFyJykuZmFkZU91dCgpO1xuXG4gICAgJCgnLmFsZXJ0YScpLmhpZGUoKTtcbiAgICAkKCdpbnB1dFtuYW1lPW5vbWVdJykudmFsKCcnKTtcbiAgICAkKCdpbnB1dFtuYW1lPXBvbHRyb25hc10nKS52YWwoJycpO1xufSk7XG5cblxuXG4kKGRvY3VtZW50KS5vbignY2xpY2snLCAnLmpzLXJlbW92ZXInLCBmdW5jdGlvbihlKXtcbiAgICBlLnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICAkKHRoaXMpLnBhcmVudHMoJ2xpJykucmVtb3ZlKCk7XG59KTtcblxuXG4kKGRvY3VtZW50KS5vbignY2xpY2snLCAnLmpzLXJlc2VydmFyJywgZnVuY3Rpb24oZSl7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgIHZhciBlc3BldGFjdWxvID0gJCh0aGlzKS5wYXJlbnRzKCdsaScpLmF0dHIoJ2RhdGEtZXNwZXRhY3VsbycpO1xuICAgIHZhciBwb2x0cm9uYXMgPSBwYXJzZUludCgkKHRoaXMpLnBhcmVudHMoJ2xpJykuYXR0cignZGF0YS1wb2x0cm9uYXMnKSk7XG5cbiAgICAkKCcubW9kYWwtLXJlc2VydmEnKS5hdHRyKCdkYXRhLWVzcGV0YWN1bG8nLCBlc3BldGFjdWxvKS5hdHRyKCdkYXRhLXBvbHRyb25hcycsIHBvbHRyb25hcykuZmFkZUluKCk7XG59KTtcblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5nZS1tb2RhbF9fcmVzZXJ2YXInLCBmdW5jdGlvbihlKXtcbiAgICBlLnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICB2YXIgbm9tZSA9ICQodGhpcykuc2libGluZ3MoJ2lucHV0W25hbWU9bm9tZV0nKS52YWwoKTtcbiAgICB2YXIgZXNwZXRhY3VsbyA9ICQoJy5tb2RhbC0tcmVzZXJ2YScpLmF0dHIoJ2RhdGEtZXNwZXRhY3VsbycpO1xuICAgIHZhciBwb2x0cm9uYXMgPSAkKCcubW9kYWwtLXJlc2VydmEnKS5hdHRyKCdkYXRhLXBvbHRyb25hcycpO1xuXG4gICAgaWYobm9tZT09Jycpe1xuICAgICAgICAkKCcuYWxlcnRhJykuaHRtbCgnUG9yIGdlbnRpbGV6YSwgZGlnaXRlIHVtIG5vbWUgcGFyYSBhIHJlc2VydmEnKS5zaG93KCk7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9XG5cbiAgICBjb25zb2xlLmxvZyhlc3BldGFjdWxvc1tlc3BldGFjdWxvXS5sZW5ndGggKycgLSAnKyBwb2x0cm9uYXMpO1xuICAgIGlmKGVzcGV0YWN1bG9zW2VzcGV0YWN1bG9dLmxlbmd0aCA+IChwb2x0cm9uYXMgLSAxKSl7XG4gICAgICAgICQoJy5hbGVydGEnKS5odG1sKCdBIHJlc2VydmFzIGVzdMOjbyBlc2dvdGFkYXMnKS5zaG93KCk7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9XG5cbiAgICBlc3BldGFjdWxvc1tlc3BldGFjdWxvXS5wdXNoKG5vbWUpO1xuICAgIGVzcGV0YWN1bG9zW2VzcGV0YWN1bG9dLnNvcnQoKTtcbiAgICB2YXIgdG90YWwgPSAocGFyc2VJbnQoZXNwZXRhY3Vsb3NbZXNwZXRhY3Vsb10ubGVuZ3RoKSoyMzc2KS8xMDA7XG5cbiAgICB2YXIgZGlzcG9uaXZlaXMgPSBwYXJzZUludChwb2x0cm9uYXMpIC0gcGFyc2VJbnQoZXNwZXRhY3Vsb3NbZXNwZXRhY3Vsb10ubGVuZ3RoKTtcblxuICAgICQoJy5lc3BldGFjdWxvW2RhdGEtZXNwZXRhY3Vsbz0nK2VzcGV0YWN1bG8rJ10gLmdlLW1haW5fX2NvbnRhaW5lci1lc3BldGFjdWxvc19fZGlzcG9uaXZlaXMgc3Ryb25nJykuaHRtbChkaXNwb25pdmVpcyk7XG4gICAgJCgnLmVzcGV0YWN1bG9bZGF0YS1lc3BldGFjdWxvPScrZXNwZXRhY3VsbysnXSAuZ2UtbWFpbl9fY29udGFpbmVyLWVzcGV0YWN1bG9zX19yZXNlcnZhZG9zIHN0cm9uZycpLmh0bWwoZXNwZXRhY3Vsb3NbZXNwZXRhY3Vsb10ubGVuZ3RoKTtcbiAgICAkKCcuZXNwZXRhY3Vsb1tkYXRhLWVzcGV0YWN1bG89Jytlc3BldGFjdWxvKyddIC5nZS1tYWluX19jb250YWluZXItZXNwZXRhY3Vsb3NfX2FycmVjYWRhY2FvIHN0cm9uZycpLmh0bWwodG90YWwudG9GaXhlZCgyKSk7XG5cbiAgICAkKCcuZ2UtbW9kYWwnKS5mYWRlT3V0KCk7XG4gICAgJCgnLmFsZXJ0YScpLmhpZGUoKTtcbiAgICAkKHRoaXMpLnNpYmxpbmdzKCdpbnB1dFtuYW1lPW5vbWVdJykudmFsKCcnKTtcbn0pO1xuXG5cbiQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcuanMtdmVyJywgZnVuY3Rpb24oZSl7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgdmFyIGVzcGV0YWN1bG8gPSAkKHRoaXMpLnBhcmVudHMoJ2xpJykuYXR0cignZGF0YS1lc3BldGFjdWxvJyk7XG4gICAgdmFyIHBvbHRyb25hcyA9IHBhcnNlSW50KCQodGhpcykucGFyZW50cygnbGknKS5hdHRyKCdkYXRhLXBvbHRyb25hcycpKTtcblxuICAgIHZhciB0b3RhbCA9IChwYXJzZUludChlc3BldGFjdWxvc1tlc3BldGFjdWxvXS5sZW5ndGgpKjIzNzYpLzEwMDtcbiAgICB0b3RhbCA9IHRvdGFsLnRvRml4ZWQoMik7XG4gICAgdmFyIGRpc3Bvbml2ZWlzID0gcGFyc2VJbnQocG9sdHJvbmFzKSAtIHBhcnNlSW50KGVzcGV0YWN1bG9zW2VzcGV0YWN1bG9dLmxlbmd0aCk7XG5cbiAgICB2YXIgbm9tZSA9ICQodGhpcykucGFyZW50KCkuc2libGluZ3MoJy5nZS1tYWluX19jb250YWluZXItZXNwZXRhY3Vsb3NfX2VzcGV0YWN1bG8nKS5odG1sKCk7XG4gICAgdmFyIHJlc2VydmFzID0gJyc7XG5cbiAgICAkLmVhY2goZXNwZXRhY3Vsb3NbZXNwZXRhY3Vsb10sIGZ1bmN0aW9uKGksIGl0ZW0pe1xuICAgICAgICByZXNlcnZhcyArPSAnPGxpPicraXRlbSsnIDxidXR0b24gY2xhc3M9XCJnZS1tYWluX19yZXNlcnZhX19jYW5jZWxhclwiIGRhdGEtZXNwZXRhY3Vsbz1cIicrZXNwZXRhY3VsbysnXCIgZGF0YS1pdGVtPVwiJytpdGVtKydcIj5DYW5jZWxhcjwvYnV0dG9uPjwvbGk+JztcbiAgICB9KTtcblxuICAgIHZhciBkYWRvc19lc3BldGFjdWxvID0gYFxuICAgICAgICA8aDMgY2xhc3M9XCJnZS1tYWluX19lc3BldGFjdWxvX190aXRsZVwiPiR7bm9tZX08L2gzPlxuICAgICAgICA8c3BhbiBjbGFzcz1cImdlLW1haW5fX2VzcGV0YWN1bG9fX2Rpc3Bvbml2ZWlzXCI+TG9jYWlzIGRpc3BvbsOtdmVpczogPHN0cm9uZz4ke2Rpc3Bvbml2ZWlzfTwvc3Ryb25nPjwvc3Bhbj5cbiAgICAgICAgPHNwYW4gY2xhc3M9XCJnZS1tYWluX19lc3BldGFjdWxvX19yZXNlcnZhZG9zXCI+TG9jYWlzIHJlc2VydmFkb3M6IDxzdHJvbmc+JHtlc3BldGFjdWxvc1tlc3BldGFjdWxvXS5sZW5ndGh9PC9zdHJvbmc+PC9zcGFuPlxuICAgICAgICA8c3BhbiBjbGFzcz1cImdlLW1haW5fX2VzcGV0YWN1bG9fX2FycmVjYWRhY2FvXCI+QXJyZWNhZGHDp8OjbzogUiQ8c3Ryb25nPiR7dG90YWx9PC9zdHJvbmc+PC9zcGFuPlxuXG4gICAgICAgIDx1bCBjbGFzcz1cImdlLW1haW5fX2VzcGV0YWN1bG9fX3Jlc2VydmFzXCI+XG4gICAgICAgICAgICAke3Jlc2VydmFzfVxuICAgICAgICA8L3VsPlxuICAgIGA7XG4gICAgXG4gICAgJCgnLmdlLW1haW5fX2VzcGV0YWN1bG8nKS5odG1sKGRhZG9zX2VzcGV0YWN1bG8pO1xuICAgICQoJy5tb2RhbC0tZXNwZXRhY3VsbycpLmZhZGVJbigpO1xufSk7XG5cblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5nZS1tYWluX19yZXNlcnZhX19jYW5jZWxhcicsIGZ1bmN0aW9uKCl7XG4gICAgdmFyIGVzcGV0YWN1bG8gPSAkKHRoaXMpLmF0dHIoJ2RhdGEtZXNwZXRhY3VsbycpO1xuICAgIHZhciBpdGVtID0gJCh0aGlzKS5hdHRyKCdkYXRhLWl0ZW0nKTtcbiAgICB2YXIgcG9sdHJvbmFzID0gJCgnLmVzcGV0YWN1bG9bZGF0YS1lc3BldGFjdWxvPScrZXNwZXRhY3VsbysnXScpLmF0dHIoJ2RhdGEtcG9sdHJvbmFzJyk7XG5cbiAgICBmb3IodmFyIGkgaW4gZXNwZXRhY3Vsb3NbZXNwZXRhY3Vsb10pe1xuICAgICAgICBpZihlc3BldGFjdWxvc1tlc3BldGFjdWxvXVtpXT09aXRlbSl7XG4gICAgICAgICAgICBlc3BldGFjdWxvc1tlc3BldGFjdWxvXS5zcGxpY2UoaSwxKTtcbiAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgdmFyIHRvdGFsID0gKHBhcnNlSW50KGVzcGV0YWN1bG9zW2VzcGV0YWN1bG9dLmxlbmd0aCkqMjM3NikvMTAwO1xuXG4gICAgdmFyIGRpc3Bvbml2ZWlzID0gcGFyc2VJbnQocG9sdHJvbmFzKSAtIHBhcnNlSW50KGVzcGV0YWN1bG9zW2VzcGV0YWN1bG9dLmxlbmd0aCk7XG5cbiAgICAkKCcuZXNwZXRhY3Vsb1tkYXRhLWVzcGV0YWN1bG89Jytlc3BldGFjdWxvKyddIC5nZS1tYWluX19jb250YWluZXItZXNwZXRhY3Vsb3NfX2Rpc3Bvbml2ZWlzIHN0cm9uZycpLmh0bWwoZGlzcG9uaXZlaXMpO1xuICAgICQoJy5lc3BldGFjdWxvW2RhdGEtZXNwZXRhY3Vsbz0nK2VzcGV0YWN1bG8rJ10gLmdlLW1haW5fX2NvbnRhaW5lci1lc3BldGFjdWxvc19fcmVzZXJ2YWRvcyBzdHJvbmcnKS5odG1sKGVzcGV0YWN1bG9zW2VzcGV0YWN1bG9dLmxlbmd0aCk7XG4gICAgJCgnLmVzcGV0YWN1bG9bZGF0YS1lc3BldGFjdWxvPScrZXNwZXRhY3VsbysnXSAuZ2UtbWFpbl9fY29udGFpbmVyLWVzcGV0YWN1bG9zX19hcnJlY2FkYWNhbyBzdHJvbmcnKS5odG1sKHRvdGFsLnRvRml4ZWQoMikpO1xuXG4gICAgJCgnLmdlLW1haW5fX2VzcGV0YWN1bG9fX2Rpc3Bvbml2ZWlzIHN0cm9uZycpLmh0bWwoZGlzcG9uaXZlaXMpO1xuICAgICQoJy5nZS1tYWluX19lc3BldGFjdWxvX19yZXNlcnZhZG9zIHN0cm9uZycpLmh0bWwoZXNwZXRhY3Vsb3NbZXNwZXRhY3Vsb10ubGVuZ3RoKTtcbiAgICAkKCcuZ2UtbWFpbl9fZXNwZXRhY3Vsb19fYXJyZWNhZGFjYW8gc3Ryb25nJykuaHRtbCh0b3RhbC50b0ZpeGVkKDIpKTtcblxuICAgICQodGhpcykucGFyZW50KCkucmVtb3ZlKCk7XG59KTsiXSwiZmlsZSI6ImpzL2FjdGlvbnMuanMiLCJzb3VyY2VSb290IjoiL3NvdXJjZS8ifQ==
