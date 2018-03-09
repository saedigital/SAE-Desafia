$(document).ready(function(){

  // delete modal

  $('#deleteModal').on('show.bs.modal', function(e) {
      var link = $(e.relatedTarget);
      var href = link.attr('href');
      $('.submit').click(function(e){ window.location.replace(href) })
  });


  // validação de formulário
  $.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-control').addClass('is-invalid');
        $(element).closest('.custom-select').addClass('is-invalid');
    },
    unhighlight: function(element) {
        $(element).closest('.form-control').removeClass('is-invalid');
        $(element).closest('.custom-select').removeClass('is-invalid');
    },
    errorElement: 'div',
    errorClass: 'invalid-feedback',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});
  $("form").validate({
    rules: {
      title:{
        required: true,
        normalizer: function(v){ return $.trim(v) }
      }
    },
    messages: {
      title: 'O campo "título" é obrigatório',
      seating_total: {
        required: 'Especifique um total de assentos à venda para este espetáculo',
        min: 'Digite um valor maior ou igual a {0}',
        max: 'Digite um valor menor ou igual a {0}',
        maxlength: 'Digite um valor até {0} dígitos',
        number: 'Digite um valor numérico',
      },
      seating_value: 'Especifique um total de assentos',
      start_date:{
        required: 'Defina a data',
        min: 'Não é possível cadastrar com data anterior a hoje',
      },
      start_time: 'Defina a hora de início',
      duration: 'Defina a duração do espetáculo',
    }
  });

})
