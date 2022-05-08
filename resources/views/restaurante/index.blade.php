@extends('layouts.mainlayout')
<head>
    <title>Restaurante</title>
</head>
@section('content')
<div class='container pt-4'></div>
<div class='container'>
    <table class="table table-striped table-bordered table-sm text-center align-middle">
        <thread class="thread-dark">
        <tr><th scope="col">id</th><th scope="col">Razão Social</th><th scope="col">CNPJ</th><th scope="col">Telefone</th><th scope="col">Endereço</th><th scope="col">Email</th><th scope="col"><a href="/restaurantes/create" class="btn btn-primary btn-sm">Novo Restaurante</a></th></tr>
            @foreach($dados as $r)
            <tr>
            <td>{{ $r->id }}</td>
            <td>{{ $r->razaoSocial }}</td>
            <td>{{ $r->cnpj }}</td>
            <td>{{ $r->telefone }}</td>
            <td>{{ $r->endereco }}</td>
            <td>{{ $r->email }}</td>
            <td>
            <a href="/restaurantes/{{$r->id}}" class="btn btn-primary btn-sm">Excluir</a>
            <a href="/restaurantes/{{$r->id}}/edit" class="btn btn-primary btn-sm">Editar</a>
            </td>
            </tr>
            @endforeach
        </thread>
    </table>
</div>
@endsection('content')
</body>
</html>