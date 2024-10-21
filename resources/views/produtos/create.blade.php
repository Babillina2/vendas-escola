@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@section('content_header')
    <h1>Cadastrar Produto</h1>
@stop

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome do Produto</label>
            <input type="text" name="nome" class="form-control" id="nome" value="{{ old('nome') }}" required>
        </div>
        <div class="form-group">
            <label for="preco">Preço</label>
            <input type="text" name="preco" class="form-control" id="preco" value="{{ old('preco') }}" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição (opcional)</label>
            <textarea name="descricao" class="form-control" id="descricao">{{ old('descricao') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
    </form>
@stop
