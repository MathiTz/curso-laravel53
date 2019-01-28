@extends('painel.templates.template')

@section('content')

@if (isset($errors) && count($errors) > 0)
	<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
			<p>{{$error}}</p>
		@endforeach
	</div>
@endif

<h1 class="title-pg">Gestão Produto</h1>


	<form class="form-group" method="post" action="{{route('produtos.store')}}">
		@csrf
	<input class="form-control" type="text" name="name" placeholder="Nome:" value="{{old(name)}}">

		<label for=""><input class="form-control" type="checkbox" name="active" value="1">Ativo?</label>

	<input class="form-control" type="text" name="number" placeholder="Números:" value="{{old(number)}}">
		<select class="form-control" name="category">
			<option value="">Escolha a categoria</option>
			@foreach($categories as $cat)
				<option value="{{$cat}}">{{$cat}}</option>
			@endforeach
		</select>

	<textarea class="form-control" name="description" placeholder="Descrição" value="{{old(description)}}"></textarea>

		<button class="btn btn-primary">Enviar</button>
	</form>

@endsection