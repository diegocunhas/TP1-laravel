@extends('layouts.mainlayout')
<head>
    <title>Restaurante {{$dados->razaoSocial}}</title>
</head>
<body>
    @section('content')
    <div class="container text-center align-middle pt-4">
        <h2>Restaurante {{$dados->razaoSocial}}</h2>
        <ul class="list-group-flush align-center">
            <li class="list-item">id: {{$dados->id}}</li>
            <li class="list-item">Razão Social: {{$dados->razaoSocial}}</li>
            <li class="list-item">CNPJ: {{$dados->cnpj}}</li>
            <li class="list-item">Telefone: {{$dados->telefone}}</li>
            <li class="list-item">Endereço: {{$dados->endereco}}</li>
            <li class="list-item">Email: {{$dados->email}}</li>
        </ul>
        <form action="/restaurantes/{{$dados->id}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="Confirmar" class="btn btn-primary btn-sm">
            <a href="/restaurantes" class="btn btn-primary btn-sm">Voltar</a>
        </form>
    </div>
    @endsection('content')
</body>