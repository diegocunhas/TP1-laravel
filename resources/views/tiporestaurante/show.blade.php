@extends('layouts.mainlayout')
<head>
    <title>Tipo de Restaurante {{$dados->descricao}}</title>
</head>
<body>
    @section('content')
    <div class="container text-center align-middle pt-4">
        <h2>Tipo de Restaurante {{$dados->descricao}}</h2>
        <ul class="list-group-flush">
            <li class="list-item">id: {{$dados->id}}</li>
            <li class="list-item">Descrição: {{$dados->descricao}}</li>
        </ul>
        <form action="/tiporestaurantes/{{$dados->id}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="Confirmar" class="btn btn-primary btn-sm">
            <a href="/tiporestaurantes" class="btn btn-primary btn-sm">Voltar</a>
        </form>
    </div>
    @endsection('content')
</body>