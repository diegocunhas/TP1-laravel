@extends('layouts.mainlayout')

@section('content')
<div class="container pt-4">
		<h3>Editar Restaurante</h3>
		<div class="row">
			<div class="col-sm-6 text-center align-middle">
				<form action="/restaurantes/{{$dados->id}}" method="post">
					@csrf  <!-- token de segurança -->
					@method('PUT') <!-- para acionar a função update do controller -->
					<div class="form-group">
						<label for="razaoSocial">Razão Social</label>
						<input type="text" name="razaoSocial" required id="razaoSocial" class="form-control" value="{{empty(old('razaoSocial')) ? $dados->razaoSocial : old('razaoSocial')}}"/>
						@if($errors->has('razaoSocial'))
						<p>{{$errors->first('razaoSocial')}}</p>
						@endif	
					</div>
					<div>
						<label for="cnpj">CNPJ</label>
						<input type="text" name="cnpj" required id="cnpj" class="form-control" value="{{empty(old('cnpj')) ? $dados->cnpj : old('cnpj')}}"/>
						@if($errors->has('cnpj'))
						<p>{{$errors->first('cnpj')}}</p>
						@endif
					</div>
					<div>
						<label for="telefone">Telefone</label>
						<input type="text" name="telefone" id="telefone" class="form-control" value="{{(empty(old('telefone')))?$dados->telefone:old('telefone')}}"/>
						@if($errors->has('telefone'))
						<p class="text-danger">{{$errors->first('telefone')}}</p>
						@endif
					</div>
                    <div>
						<label for="endereco">Endereço</label>
						<input type="text" name="endereco" id="endereco" class="form-control" value="{{(empty(old('endereco')))?$dados->endereco:old('endereco')}}"/>
						@if($errors->has('endereco'))
						<p class="text-danger">{{$errors->first('endereco')}}</p>
						@endif
					</div>
                    <div>
						<label for="email">Email</label>
						<input type="text" name="email" id="email" class="form-control" value="{{(empty(old('email')))?$dados->email:old('email')}}"/>
						@if($errors->has('email'))
						<p class="text-danger">{{$errors->first('email')}}</p>
						@endif
					</div>
		    		<input type="submit" value="Alterar" class="btn btn-primary btn-sm" />
		    		<a href="/restaurantes" class="btn btn-primary btn-sm">Voltar</a>
				</form>
			</div>
		</div>
	</div>
	@endsection('content')