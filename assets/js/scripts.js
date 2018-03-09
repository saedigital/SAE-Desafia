$(document).ready(function(){

  cards_heigth();
  $(window).resize(function(){
    cards_heigth();
  })

  // deleteModal
  $('#deleteModal').on('show.bs.modal', function(e) {
      var link = $(e.relatedTarget);
      var href = link.attr('href');
      $('.submit').click(function(e){ window.location.replace(href) })
  });

  // select seats
  $('#reserve_form .seat input[type="checkbox"]').change(function(){
    var input = $(this);
    var id = input.val();
    var seat = input.parents('.seat');
    var submit = $('#reserve_form button[type="submit"]');
    var status = $('.confirm .status');
    var seat_value = $('#reserve_form input[name="seat_value"]').val();

    if(input.is(':checked')){
      seat.addClass('bg-warning');
    }else{
      seat.removeClass('bg-warning');
    }

    var checked = $('#reserve_form .seat input[type="checkbox"]:checked').length;
    if(checked === 0){
      status.text('Escolha uma ou mais poltronas');
      submit.prop('disabled', true);
    }else{
      var value = (seat_value * checked).toFixed(2).replace(".",",");
      // value = toFixed(2);
      if(checked === 1){
        status.text('Você selecionou uma poltrona. Total a pagar: R$ ' + value);
      }else{
        status.text('Você selecionou ' + checked + ' poltronas. Total a pagar: R$ ' + value);
      }
      submit.prop('disabled', false);
    }

  });


});

// cards with same height
function cards_heigth(){
  if($(window).width() > 576 ){
    var card_height = 0;
    $('.card-body', '.shows-wrapper').each(function(){
      var height = $(this).innerHeight();
      if(height > card_height) card_height = height;
      console.log(height);
    });
    $('.shows-wrapper .card .card-body').css({'height':card_height});
  }else{
    $('.shows-wrapper .card .card-body').css({'height':'auto'});
  }
}
