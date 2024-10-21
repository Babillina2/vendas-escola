@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Tela de Vendas</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-3">
        <!-- Sidebar menu -->
        <div class="card">
            <div class="card-body box-profile">
                <!-- Logo da Escola -->
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('./img/CA_SF.png') }}" alt="Logo da Escola">
                </div>
                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                <p class="text-muted text-center">Usuário Logado</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Escolas</b> <a href="{{ route('escolas.index') }}" class="float-right">Cadastro</a>
                    </li>
                    <li class="list-group-item">
                        <b>Usuários</b> <a href="{{ route('usuarios.index') }}" class="float-right">Cadastro</a>
                    </li>
                    <li class="list-group-item">
                        <b>Produtos</b> <a href="{{ route('produtos.index') }}" class="float-right">Cadastro</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Tela de Vendas -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Vendas</h3>
            </div>
            <div class="card-body">
                <!-- Conteúdo da tela de vendas vai aqui -->
                <form>
                    <div class="form-group">
                        <label for="product">Produto:</label>
                        <input type="text" class="form-control" id="product" placeholder="Digite o nome do produto">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantidade:</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Quantidade">
                    </div>
                    <div class="form-group">
                        <label for="total">Valor Total:</label>
                        <input type="text" class="form-control" id="total" placeholder="Valor Total">
                    </div>
                    <button type="submit" class="btn btn-primary">Finalizar Venda</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <!-- Adicione seu CSS customizado aqui -->
@stop

@section('js')
    <!-- Adicione seu JavaScript customizado aqui -->
@stop
