/**
 * Scripts para a página admin.php
 * Criado em janeiro/2018
 * @author: Ander
 */

/**
 * Inserir espetáculo
 */
$(document).ready(function () {
    $('#form_cadastro').submit(function () {
        
        var nome_espetaculo = $('#nome_espetaculo').val();
        var data_espetaculo = $('#data_espetaculo').val();
        var hora_espetaculo = $('#hora_espetaculo').val();
        
        $.ajax({
            type: "POST",
            url: "config/action_espetaculo.php",
            data: {
                acao: 'inserir',
                nome_espetaculo: nome_espetaculo,
                data_espetaculo: data_espetaculo,
                hora_espetaculo: hora_espetaculo
            },
            success: function (data)
            {
                if(data == 1){
                    window.location.href = 'admin.php';
                }else{
                    alert('Erro ao cadastrar o espetáculo.');
                }                
            }
        });
        return false;
    });
});

/**
 * Editar espetáculo
 */
$(document).ready(function () {
    $(document).on('click', '.editar', function () {
        var id = $(this).data('id');

        var espetaculo = $(this).closest('#tr_' + id).find('td[data-esp_nome]').data('esp_nome');
        var data_espetaculo = $(this).closest('#tr_' + id).find('td[data-esp_data]').data('esp_data');
        var hora_espetaculo = $(this).closest('#tr_' + id).find('td[data-esp_hora]').data('esp_hora');

        $("#editar").find("input[name='nome_espetaculo']").val(espetaculo);
        $("#editar").find("input[name='data_espetaculo']").val(data_espetaculo);
        $("#editar").find("input[name='hora_espetaculo']").val(hora_espetaculo);
        $("#editar").find(".edit-id").val(id);
    });
});

/**
 * Atualizar espetáculo
 */
$(document).ready(function () {
    $('#form_atualiza').submit(function () {
        var id = $("#editar").find(".edit-id").val();
        var nome_espetaculo = $("#editar").find("#nome_espetaculo").val();
        var data_espetaculo = $("#editar").find("#data_espetaculo").val();
        var hora_espetaculo = $("#editar").find("#hora_espetaculo").val();

        $.ajax({
            type: "POST",
            url: "config/action_espetaculo.php",
            data: {
                acao: 'editar',
                id: id,
                nome_espetaculo: nome_espetaculo,
                data_espetaculo: data_espetaculo,
                hora_espetaculo: hora_espetaculo
            },
            success: function (data)
            {
                if(data == 0){
                    alert('Erro ao atualizar o espetáculo.');
                }
                window.location.href = 'admin.php';                
            }
        });
        return false;
    });
});

/**
 * Deletar espetáculo
 */
$(document).ready(function () {
    $(document).on('click', '.deletar', function () {
        var id = $(this).data('id');

        $.ajax({
            url: 'config/action_espetaculo.php',
            type: 'POST',
            data: {
                acao: 'excluir',
                id: id
            },
            success: function (data)
            {
                if(data == 1){
                    $('#tr_' + id).fadeOut('slow');
                    window.setTimeout(function () {
                        location.reload()
                    }, 2000)
                } 
            }
        });
        return false;
    });
});

/**
 * Máscaras de entrada
 */
$(function ($) {
    $("#data_espetaculo").mask("99/99/9999");
    $("#hora_espetaculo").mask("99:99");
});




