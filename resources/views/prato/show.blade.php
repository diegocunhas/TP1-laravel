<!DOCTYPE html>
<html>
<head>
    <title>Prato {{dados->nome}}</title>
</head>
<body>
    <div class=container>
        <h2>Prato {{dados->nome}}</h2>
        <ul>
            <li>ID {{id}}</li>
            <li>Descrição {{descricao}}</li>
            <li>Nome {{nome}}</li>
            <li>Preço {{preco}}</li>
            <li>Restaurante {{restaurante_id}}</li>
        </ul>
        <form action="/classroom/{{$dados->id}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="Confirmar" class="btn btn-primary btn-sm">
            <a href="/prato.index" class="btn btn-primary btn-sm">Voltar</a>
        </form>
    </div>
</body>
</html>