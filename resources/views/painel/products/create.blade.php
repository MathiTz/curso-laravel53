@extends('painel.templates.template')

@section('content')

<h1 class="title-pg">Gestão Produto</h1>
	
	<form class="form-group" method="post" action="{{route('produtos.store')}}">
		 @csrf
		<input class="form-control" type="text" name="name" placeholder="Nome:">

		<label for=""><input class="form-control" type="checkbox" name="active" value="1">Ativo?</label>

		<input class="form-control" type="text" name="number" placeholder="Números:">
		<select class="form-control" name="category">
			<option value="">Escolha a categoria</option>
			@foreach($categories as $cat)
				<option value="{{$cat}}">{{$cat}}</option>
			@endforeach
		</select>

		<textarea class="form-control" name="description" placeholder="Descrição"></textarea>

		<button class="btn btn-primary">Enviar</button>
	</form>

@endsection