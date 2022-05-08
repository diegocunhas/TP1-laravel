@extends('layouts.mainlayout')
<head>
    <title>Prato</title>
</head>
<body>
    @section('content')
    <table >
    <tr><th>id</th><th>Descrição</th><th>Nome</th><th>Preço</th><th>restaurante_id</th></tr>
    @foreach($dados as $p)
      <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->tipo }}</td>
          <td>{{ $p->nome }}</td>
          <td>{{ $p->preco }}</td>
          <td>{{ $p->restaurante_id }}</td>
          <td>
          <a href="/prato/{{$p->id}}" class="btn btn-primary btn-sm">Excluir</a>
          <a href="/classroom/{{$p->id}}/edit" class="btn btn-primary btn-sm">Editar</a>
          </td>
      </tr>
    @endforeach
    </table>
    @endsection('content')
</body>
</html>