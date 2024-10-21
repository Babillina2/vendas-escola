@extends('adminlte::page')

@section('title', 'Editar Escola')

@section('content_header')
    <h1>Editar Escola</h1>
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

    <form action="{{ route('escolas.update', $escola->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Necessário para o método PUT -->
        
        <div class="form-group">
            <label for="nome">Nome da Escola</label>
            <input type="text" name="nome" class="form-control" id="nome" value="{{ old('nome', $escola->nome) }}" required>
        </div>
        <div class="form-group">
            <label for="responsavel">Responsável</label>
            <input type="text" name="responsavel" class="form-control" id="responsavel" value="{{ old('responsavel', $escola->responsavel) }}" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control" id="telefone" value="{{ old('telefone', $escola->telefone) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $escola->email) }}" required>
        </div>
        <div class="form-group">
            <label for="cnpj">CNPJ (opcional)</label>
            <input type="text" name="cnpj" class="form-control" id="cnpj" value="{{ old('cnpj', $escola->cnpj) }}">
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
@stop
