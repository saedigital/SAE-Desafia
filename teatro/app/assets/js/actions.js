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