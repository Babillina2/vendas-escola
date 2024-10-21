@extends('adminlte::page')

@section('title', 'Cadastrar Cliente')

@section('content_header')
    <h1>Cadastrar Cliente</h1>
@stop

@section('content')
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control" id="nome" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control" id="telefone" required>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
    </form>
@stop
