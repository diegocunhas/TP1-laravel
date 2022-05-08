@extends('layouts.mainlayout')
<head>
    <title>Tipo de Restaurante</title>
</head>
@section('content')
<div class='container pt-4'></div>
<div class='container'>
    <table class="table table-striped table-bordered table-sm text-center align-middle">
        <thread class="thread-dark">
        <tr><th scope="col">id</th><th scope="col">Descrição</th><th scope="col"><a href="/tiporestaurantes/create" class="btn btn-primary btn-sm">Novo Tipo de Restaurante</a></th></tr>
            @foreach($dados as $t)
            <tr>
            <td>{{ $t->id }}</td>
            <td>{{ $t->descricao }}</td>
            <td>
            <a href="/tiporestaurantes/{{$t->id}}" class="btn btn-primary btn-sm">Excluir</a>
            <a href="/tiporestaurantes/{{$t->id}}/edit" class="btn btn-primary btn-sm">Editar</a>
            </td>
            </tr>
            @endforeach
        </thread>
    </table>
</div>
@endsection('content')
</body>
</html>