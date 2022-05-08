@extends('layouts.mainlayout')

@section('content')
<div class="container pt-4">
		<h3>Editar Tipo de Restaurante {{$dados->descricao}}</h3>
		<div class="row">
			<div class="col-sm-6 text-center align-middle">
				<form action="/tiporestaurantes/{{$dados->id}}" method="post">
					@csrf  <!-- token de segurança -->
					@method('PUT') <!-- para acionar a função update do controller -->
					<div class="form-group">
						<label for="descricao">Descrição</label>
						<input type="text" name="descricao" required id="descricao" class="form-control" value="{{empty(old('descricao')) ? $dados->descricao : old('descricao')}}"/>
						@if($errors->has('descricao'))
						<p>{{$errors->first('descricao')}}</p>
						@endif	
					</div>
		    		<input type="submit" value="Alterar" class="btn btn-primary btn-sm" />
		    		<a href="/tiporestaurantes" class="btn btn-primary btn-sm">Voltar</a>
				</form>
			</div>
		</div>
	</div>
	@endsection('content')