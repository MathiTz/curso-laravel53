@extends('painel.templates.template')

@section('content')

<h1 class="title-pg">Gestão Produto</h1>

	@if (isset($errors) && count($errors) > 0)
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				<p>{{$error}}</p>
			@endforeach
		</div>
	@endif

		@if(isset($product))
			<form class="form-group" method="post" action="{{route('produtos.update', $product->id)}}">
				{!! method_field('PUT') !!}
		@else
			<form class="form-group" method="post" action="{{route('produtos.store')}}">
		@endif

		@csrf
		<input class="form-control" type="text" name="name" placeholder="Nome:" value="{{$product->name ?? old('name')}}">

		<label for=""><input class="form-control" type="checkbox" name="active" value="1" @if( isset($product) && $product->active =='1') checked @endif>Ativo?</label>

		<input class="form-control" type="text" name="number" placeholder="Números:" value="{{$product->number ?? old('number')}}">
			<select class="form-control" name="category">
				<option value="">Escolha a categoria</option>
				@foreach($categories as $cat)
					<option value="{{$cat}}">
							@if (isset($product) && $product->category == $cat)
								selected
							@endif
						{{$cat}}</option>
				@endforeach
			</select>

		<textarea class="form-control" name="description" placeholder="Descrição" value="{{$product->description ?? old('description')}}">
		</textarea>

		<button class="btn btn-primary">Enviar</button>
	</form>

@endsection