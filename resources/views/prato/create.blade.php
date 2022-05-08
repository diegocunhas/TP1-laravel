@extends('layouts.mainlayout')

@section('content')
<div class="container pt-4">
    <div class="row">
        <div class="col-sm-6 text-center align-middle">
            <h4>Adicionar Novo Prato</h4>
            <form action="/pratos" method="post">
                @csrf  <!-- token de segurança -->
                @method('POST') <!-- para acionar a função update do controller -->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{old('nome')}}"/>
                    @if($errors->has('nome'))
                    <p>{{$errors->first('nome')}}</p>
                    @endif	
                </div>
                <div>
                    <label for="tipo">Tipo de alimento</label>
                    <input type="text" name="tipo" id="tipo" class="form-control" value="{{old('descricao')}}"/>
                    @if($errors->has('tipo'))
                    <p>{{$errors->first('tipo')}}</p>
                    @endif
                </div>
                <div>
                    <label for="preco">Preço</label>
                    <input type="text" name="preco" id="preco" class="form-control" value="{{old('preco')}}"/>
                    @if($errors->has('preco'))
                    <p class="text-danger">{{$errors->first('preco')}}</p>
                    @endif
                </div>
                <div>
                    <label for="restaurante_id">Restaurante_id</label>
                    <input type="text" name="restaurante_id" id="restaurante_id" class="form-control" value="{{old('restaurante_id')}}"/>
                    @if($errors->has('restaurante_id'))
                    <p class="text-danger">{{$errors->first('restaurante_id')}}</p>
                    @endif
                </div>
                <input type="submit" value="Criar" class="btn btn-primary btn-sm"/>
                <a href="/pratos" class="btn btn-primary btn-sm">Voltar</a>
            </form>
        </div>
    </div>
</div>
@endsection('content')