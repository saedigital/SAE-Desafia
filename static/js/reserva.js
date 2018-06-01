function onLoaderFunc() {
  $('.seatStructure *').prop('disabled', true);
  $('.displayerBoxes *').prop('disabled', true);
  $('#editarEspetaculo').hide();
}

function takeData() {
  if ($('#Username').val().length == 0 || $('#Numseats').val().length == 0) {
    alert('Por favor, insira seu Nome e Número de Assentos ');
  } else {
    $('.inputForm *').prop('disabled', true);
    $('.seatStructure *').prop('disabled', false);
    document.getElementById('notification').innerHTML =
      '<b style="margin-bottom: 0;">Ok, Agora Selecione seu(s) Assento(s)</b>';
  }
}

function updateTextArea() {
  if ($('input:checked').length == $('#Numseats').val()) {
    $('.seatStructure *').prop('disabled', true);

    $('#editarEspetaculo').show();

    var spectacle;
    var name;
    var seatsNumbers;
    var allSeatsVals = [];

    //Storing
    spectacle = $('#espetaculo option:selected').val();
    name = $('#Username').val();
    seatsNumbers = $('#Numseats').val();
    $('#seatsBlock :checked').each(function() {
      allSeatsVals.push($(this).val());
    });

    //Displaying
    $('#espeDisplay').val(spectacle);
    $('#nameDisplay').val(name);
    $('#NumberDisplay').val(seatsNumbers);
    $('#seatsDisplay').val(allSeatsVals);
  } else {
    alert('Por favor, Selecione ' + $('#Numseats').val() + ' assentos');
  }
}

function myFunction() {
  alert($('input:checked').length);
}

$(':checkbox').click(function() {
  if ($('input:checked').length == $('#Numseats').val()) {
    $(':checkbox').prop('disabled', true);
    $(':checked').prop('disabled', false);
  } else {
    $(':checkbox').prop('disabled', false);
  }
});

var test = 'R$ 1.700,90';
function edit() {
  $('.seatStructure *').prop('disabled', false);
  $('.displayerBoxes *').prop('disabled', false);
  $('.inputForm *').prop('disabled', false);
  $('#espetaculo').prop('selectedIndex', 0);
  $('#Username').val('');
  $('#Numseats').val('');
  $('.seats').prop('checked', false );
  $('#editarEspetaculo').hide();
  $('#espeDisplay, #nameDisplay, #NumberDisplay, #seatsDisplay').val('');
  $('body').scrollTop(0);
}


$(function(){

    var totalassentos = 0;
    var assentoslivres = 0;
    var totalarrecadado = 0;
    var valorassentos = 23.76;

    $( ".soma-assentos" ).each(function() {
      totalassentos += parseInt($( this ).text());
      totalarrecadado = totalassentos * valorassentos;
      assentoslivres = 120 - totalassentos;
    });

    $( "#qtdtotal" ).text(totalassentos);
    $( "#aslivres" ).text(assentoslivres);
    $( "#v_total" ).text('R$ ' + (Number(totalarrecadado)).toLocaleString('pt-BR'));

  })
