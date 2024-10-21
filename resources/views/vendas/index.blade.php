@extends('adminlte::page')

@section('title', 'Lista de Vendas')

@section('content_header')
    <h1>Lista de Vendas</h1>
@stop

@section('content')
    <a href="{{ route('vendas.create') }}" class="btn btn-primary mb-3">Cadastrar Nova Venda</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Valor Total</th>
                <th>Status</th>
                <th>Produtos</th>
                <th>Nomes das Crianças</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $venda)
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ $venda->cliente->nome ?? 'N/A' }}</td>
                    <td>{{ $venda->valor_total }}</td>
                    <td>{{ $venda->status }}</td>
                    <td>
                        @foreach($venda->produtos as $produto)
                            {{ $produto->nome }} ({{ $produto->pivot->quantidade }} unidades)<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($venda->nomesCriancas as $crianca)
                            {{ $crianca->nome_crianca }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" style="display:inline-block;">
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
