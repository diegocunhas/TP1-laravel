@extends('layouts.mainlayout')
<head>
    <title>Prato</title>
</head>
@section('content')
<div class='container pt-4'></div>
<div class='container'>
    <table class="table table-striped table-bordered table-sm text-center align-middle">
        <thread class="thread-dark">
        <tr><th scope="col">id</th><th scope="col">Nome</th><th scope="col">Tipo de alimento</th><th scope="col">Preço</th><th scope="col">restaurante_id</th><th scope="col"><a href="/pratos/create" class="btn btn-primary btn-sm">Novo Prato</a></th></tr>
            @foreach($dados as $p)
            <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nome }}</td>
            <td>{{ $p->tipo }}</td>
            <td>{{ $p->preco }}</td>
            <td>{{ $p->belongsTo(App\Models\Restaurante::class)->first()->nome }}</td>
            <td>
            <a href="/pratos/{{$p->id}}" class="btn btn-primary btn-sm">Excluir</a>
            <a href="/pratos/{{$p->id}}/edit" class="btn btn-primary btn-sm">Editar</a>
            </td>
            </tr>
            @endforeach
        </thread>
    </table>
</div>
@endsection('content')
</body>
</html>