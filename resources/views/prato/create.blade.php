<div class="container">
    <h3>Novo Prato</h3>
    <div class="row">
        <div class="col-sm-6">
            <form action="/prato/{{$dados->id}}" method="post">
                @csrf  <!-- token de segurança -->
                @method('POST') <!-- para acionar a função update do controller -->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{empty(old('nome')) ? $dados->nome : old('nome')}}"/>
                    @if($errors->has('nome'))
                    <p>{{$errors->first('nome')}}</p>
                    @endif	
                </div>
                <div>
                    <label for="descricao">Descricao</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" value="{{empty(old('descricao')) ? $dados->descricao : old('descricao')}}"/>
                    @if($errors->has('descricao'))
                    <p>{{$errors->first('descricao')}}</p>
                    @endif
                </div>
                <div>
                    <label for="preco">Preço</label>
                    <input type="text" name="preco" id="preco" class="form-control" value="{{(empty(old('preco')))?$dados->preco:old('preco')}}"/>
                    @if($errors->has('preco'))
                    <p class="text-danger">{{$errors->first('preco')}}</p>
                    @endif
                </div>
                <div>
                    <label for="restaurante_id">Restaurante_id</label>
                    <input type="text" name="restaurante_id" id="restaurante_id" class="form-control" value="{{(empty(old('restaurante_id')))?$dados->restaurante_id:old('restaurante_id')}}"/>
                    @if($errors->has('restaurante_id'))
                    <p class="text-danger">{{$errors->first('restaurante_id')}}</p>
                    @endif
                </div>
                <input type="submit" value="Criar" class="btn btn-primary btn-sm"/>
                <a href="/prato.index" class="btn btn-primary btn-sm">Voltar</a>
            </form>
        </div>
    </div>
</div>