@extends('layout.app')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Autor</th>
                <th>Data</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach($espetaculos as $espetaculo)
                <tr>
                    <td>{{$espetaculo->nome}}</td>
                    <td>{{$espetaculo->autor}}</td>
                    <td>{{date('d/m/Y', strtotime($espetaculo->data))}}</td>
                    <td>
                        <a href="/espetaculos/{{$espetaculo->id}}/edit">Detalhar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
