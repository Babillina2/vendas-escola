@extends('adminlte::page')

@section('title', 'Cadastrar Escola')

@section('content_header')
    <h1>Cadastrar Escola</h1>
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

    <form action="{{ route('escolas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome da Escola</label>
            <input type="text" name="nome" class="form-control" id="nome" value="{{ old('nome') }}" required>
        </div>
        <div class="form-group">
            <label for="responsavel">Responsável</label>
            <input type="text" name="responsavel" class="form-control" id="responsavel" value="{{ old('responsavel') }}" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control" id="telefone" value="{{ old('telefone') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="cnpj">CNPJ (opcional)</label>
            <input type="text" name="cnpj" class="form-control" id="cnpj" value="{{ old('cnpj') }}">
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar Escola</button>
    </form>
@stop
