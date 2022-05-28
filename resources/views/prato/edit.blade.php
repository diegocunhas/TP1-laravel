@extends('layouts.mainlayout')

@section('content')
<div class="container pt-4">
		<h3>Editar Prato</h3>
		<div class="row">
			<div class="col-sm-6 text-center align-middle">
				<form action="/pratos/{{$dados->id}}" method="post">
					@csrf  <!-- token de segurança -->
					@method('PUT') <!-- para acionar a função update do controller -->
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome" class="form-control" value="{{empty(old('nome')) ? $dados->nome : old('nome')}}"/>
						@if($errors->has('nome'))
						<p>{{$errors->first('nome')}}</p>
						@endif	
					</div>
					<div>
						<label for="tipo">Tipo de alimento</label>
						<input type="text" name="tipo" id="tipo" class="form-control" value="{{empty(old('tipo')) ? $dados->tipo : old('tipo')}}"/>
						@if($errors->has('tipo'))
						<p>{{$errors->first('tipo')}}</p>
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
						<!-- <input type="text" name="restaurante_id" id="restaurante_id" class="form-control" value="{{(empty(old('restaurante_id')))?$dados->restaurante_id:old('restaurante_id')}}"/> -->
						<select name="restaurante_id" id="restaurante_id" class="form-control" value="{{old('restaurante_id')}}" >
                        @foreach ($rest as $r) 
						<!-- esse if serve para mostrar na lista de seleção o valor anteriormente nela, substitui o usoo do old('restaurante_id') -->
						 @if($dados->restaurante_id == $r->id)
                         <option value="{{$r->id}}" align="center" selected >{{$r->razaoSocial}}</option>
                         @else
						 <option value="{{$r->id}}" align="center" >{{$r->razaoSocial}}</option>
						 @endif
						@endforeach
                    	</select>
					</div>
		    		<input type="submit" value="Alterar" class="btn btn-primary btn-sm" />
		    		<a href="/pratos" class="btn btn-primary btn-sm">Voltar</a>
				</form>
			</div>
		</div>
	</div>
	@endsection('content')