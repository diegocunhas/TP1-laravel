
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
            @foreach($dados as $resta)
            <tr>
            <td>{{ $resta->id }}</td>
            <td>{{ $resta->razaoSocial }}</td>
            <td>{{ $resta->cnpj }}</td>
            <td>{{ $resta->telefone }}</td>
            <td>{{ $resta->endereco }}</td>
            <td>{{ $resta->email }}</td>
            <td>
                <!-- --> 
            <td>
            <td>
            <a href="/restaurantes/{{$resta->id}}" class="btn btn-primary btn-sm">Excluir</a>
            <a href="/restaurantes/{{$resta->id}}/edit" class="btn btn-primary btn-sm">Editar</a>
            </td>
            </tr>
            @endforeach
        </thread>
    </table>
</div>
@endsection('content')
</body>
</html>