@extends('layouts.mainlayout')
<head>
    <title>Prato {{$dados->nome}}</title>
</head>
<body>
    @section('content')
    <div class="container text-center align-middle pt-4">
        <h2>Prato {{$dados->nome}}</h2>
        <ul class="list-group-flush">
            <li class="list-item">id: {{$dados->id}}</li>
            <li class="list-item">Nome: {{$dados->nome}}</li>
            <li class="list-item">Tipo de Alimento: {{$dados->tipo}}</li>
            <li class="list-item">Preço: {{$dados->preco}}</li>
            <li class="list-item">Restaurante: {{$dados->restaurante_id}}</li>
        </ul>
        <form action="/pratos/{{$dados->id}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="Confirmar" class="btn btn-primary btn-sm">
            <a href="/pratos" class="btn btn-primary btn-sm">Voltar</a>
        </form>
    </div>
    @endsection('content')
</body>