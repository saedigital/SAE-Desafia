@extends('layout.app')

@section('content')

    <form action="/espetaculos/" method="POST" class="form">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" class="form-control" required >
        </div>
        <div class="form-group">
            <label for="autor">Autor:</label>
            <input type="text" name="autor" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" name="data" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

@endsection
