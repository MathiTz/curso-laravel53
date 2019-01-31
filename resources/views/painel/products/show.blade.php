@extends('painel.templates.template')

@section('content')

    @if (isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
    @endif

    <h1 class="title-pg">
        <a href="{{route('produtos.index')}}">VOLTAR</a>
        Produto: <b>{{$product->name}}</b>
    </h1>

        <p><b>Ativo:</b> {{$product->active}}</p>
        <p><b>Número:</b> {{$product->number}}</p>
        <p><b>Categoria:</b> {{$product->category}}</p>
        <p><b>Descrição:</b> {{$product->description}}</p>

        <hr>

        {{Form::open(['route' => ['produtos.destroy', $product->id], 'method'=>'delete'])}}
            {{Form::submit("Deletar Produto: $product->name", ['class' => 'btn btn-danger'])}}
        {{Form::close()}}
@endsection