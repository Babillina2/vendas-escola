@extends('adminlte::page')

@section('title', 'Escolas')

@section('content_header')
    <h1>Lista de Escolas</h1>
@stop

@section('content')
    <a href="{{ route('escolas.create') }}" class="btn btn-primary mb-3">Cadastrar Nova Escola</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Responsável</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>CNPJ</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($escolas as $escola)
                <tr>
                    <td>{{ $escola->id }}</td>
                    <td>{{ $escola->nome }}</td>
                    <td>{{ $escola->responsavel }}</td>
                    <td>{{ $escola->telefone }}</td>
                    <td>{{ $escola->email }}</td>
                    <td>{{ $escola->cnpj }}</td>
                    <td>
                        <a href="{{ route('escolas.edit', $escola->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('escolas.destroy', $escola->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
