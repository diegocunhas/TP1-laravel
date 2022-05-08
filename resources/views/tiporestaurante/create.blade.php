@extends('layouts.mainlayout')

@section('content')
<div class="container pt-4">
    <div class="row">
        <div class="col-sm-6 text-center align-middle">
            <h4>Adicionar Novo Tipo de Restaurante</h4>
            <form action="/tiporestaurantes" method="post">
                @csrf  <!-- token de segurança -->
                @method('POST') <!-- para acionar a função update do controller -->
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" required id="descricao" class="form-control" value="{{old('descricao')}}"/>
                    @if($errors->has('descricao'))
                    <p>{{$errors->first('descricao')}}</p>
                    @endif	
                </div>
                <input type="submit" value="Criar" class="btn btn-primary btn-sm"/>
                <a href="/tiporestaurantes" class="btn btn-primary btn-sm">Voltar</a>
            </form>
        </div>
    </div>
</div>
@endsection('content')