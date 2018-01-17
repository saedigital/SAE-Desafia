@extends('layout.app')

@section('content')

    <form action="/reservas/" method="POST" class="form">
        {{ csrf_field() }}
        <input type="hidden" name="poltrona" value="{{$poltrona}}">
        <input type="hidden" name="espetaculo" value="{{$espetaculo}}">
        <input type="hidden" name="status" value="1">
        <div class="form-group">
            <label for="cpf" >CPF:</label>
            <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" name="cpf" class="form-control" maxlength="11" required>
        </div>
        <div class="form-group">
            <label for="preco" >Preco:</label>
            <input type="text" name="preco" class="form-control" required value="23.76">
        </div>
        <button type="submit" class="btn btn-primary">Reservar</button>
    </form>

@endsection
