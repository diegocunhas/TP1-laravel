@extends('layouts.mainlayout')

@section('content')
<div class="container pt-4">
    <div class="row">
        <div class="col-sm-6 text-center align-middle">
            <h4>Adicionar Novo Restaurante</h4>
            <form action="/restaurantes" method="post">
                @csrf  <!-- token de segurança -->
                @method('POST') <!-- para acionar a função update do controller -->
                <div class="form-group">
                    <label for="razaoSocial">Razão Social</label>
                    <input type="text" name="razaoSocial" required id="razaoSocial" class="form-control" value="{{old('razaoSocial')}}"/>
                    @if($errors->has('razaoSocial'))
                    <p>{{$errors->first('razaoSocial')}}</p>
                    @endif	
                </div>
                <div>
                    <label for="cnpj">CNPJ</label>
                    <input type="text" name="cnpj" required id="cnpj" class="form-control" value="{{old('descricao')}}"/>
                    @if($errors->has('cnpj'))
                    <p>{{$errors->first('cnpj')}}</p>
                    @endif
                </div>
                <div>
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" required id="telefone" class="form-control" value="{{old('telefone')}}"/>
                    @if($errors->has('telefone'))
                    <p class="text-danger">{{$errors->first('telefone')}}</p>
                    @endif
                </div>
                <div>
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" required id="endereco" class="form-control" value="{{old('endereco')}}"/>
                    @if($errors->has('endereco'))
                    <p class="text-danger">{{$errors->first('endereco')}}</p>
                    @endif
                </div>
                <div>
                    <label for="email">email</label>
                    <input type="text" name="email" required id="email" class="form-control" value="{{old('email')}}"/>
                    @if($errors->has('email'))
                    <p class="text-danger">{{$errors->first('email')}}</p>
                    @endif
                </div>
                <!-- Em restaurante não existe a chave estrangeira tipo_restaurante_id, vai passar para o controller
                 como tipo_restaurante_id para esse dado poder ser trabalhado -->
                    <label for="tipo_restaurante_id">Tipo de Restaurante</label>
                    <select name="tipo_restaurante_id" id="tipo_restaurante_id" class="form-control" value="" >
                        @foreach ($tipoR as $t)
                        <option value="{{$t->id}}" align="center" >{{$t->descricao}}</option>
                        @endforeach
                    </select>                
                <br>
                <input type="submit" value="Criar" class="btn btn-primary btn-sm"/>
                <a href="/restaurantes" class="btn btn-primary btn-sm">Voltar</a>
            </form>
        </div>
    </div>
</div>
@endsection('content')