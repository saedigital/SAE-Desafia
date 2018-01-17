@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h2>Editar dados</h2>
                </div>
                <div class="panel-body">
                    <form action="/espetaculos/{{$espetaculo->id}}" method="POST" class="form">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" class="form-control" value="{{$espetaculo->nome}}" required>
                        </div>
                        <div class="form-group">
                            <label for="autor">Autor:</label>
                            <input type="text" name="autor" class="form-control" value="{{$espetaculo->autor}}" required>
                        </div>
                        <div class="form-group">
                            <label for="data">Data:</label>
                            <input type="date" name="data" class="form-control" value="{{$espetaculo->data}}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h2>Estatísticas</h2>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>Total de Poltronas: {{count($poltronas)}}</li>
                        <li>Poltronas Reservadas: {{count($espetaculo->reservas)}}</li>
                        <li>Total arrecadado: R$ {{number_format($espetaculo->reservas->sum('preco'), 2)}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Reservar poltrona</h2>
            <table class="table">
                <tbody>
                @foreach($poltronas as $poltrona)
                    <tr>
                        <td>{{$poltrona->id}}</td>
                        @if(in_array($poltrona->id, $reservadas))
                            <td><a style="color: #9c2124;" href="/reservas/remove/{{$poltrona->id}}/{{$espetaculo->id}}">Remover reserva</a></td>
                        @else
                            <td><a href="/reservas/create/{{$poltrona->id}}/{{$espetaculo->id}}">Reservar</a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h2>Remover Espetáculo</h2>
                <form method="POST" action="/espetaculos/{{$espetaculo->id}}" >
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <p>Ao clicar no botão abaixo será removido o espetaculo e todas as suas reservas.</p>
                    <button type="submit" class="btn btn-danger">Remover</button>
                </form>
            </div>
        </div>
    </div>


@endsection
