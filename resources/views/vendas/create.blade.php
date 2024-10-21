@extends('adminlte::page')

@section('title', 'Nova Venda')

@section('content_header')
<h1>Nova Venda</h1>
@stop

@section('content')
<div class="row">
    <!-- Card 1: Buscar ou cadastrar cliente -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cliente</h3>
            </div>
            <div class="card-body">
                <!-- Campo de busca por cliente -->
                <div class="form-group">
                    <label for="buscar_cliente">Buscar Cliente</label>
                    <input type="text" id="buscar_cliente" class="form-control" placeholder="Digite o email ou nome do cliente">
                    <input type="hidden" name="cliente_id" id="cliente_id">
                </div>
                <button type="button" class="btn btn-primary" id="buscar-cliente-btn">Buscar Cliente</button>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNovoCliente">Novo Cliente</button>
            </div>
        </div>
    </div>

    <!-- Card 2: Associar criança e produtos -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Aluno e Produtos</h3>
            </div>
            <div class="card-body">
                <!-- Associar criança ao cliente -->
                <div class="form-group">
                    <label for="nome_crianca">Nome do Aluno</label>
                    <input type="text" id="nome_crianca" class="form-control" placeholder="Nome da criança">
                </div>

                <!-- Adicionar produtos -->
                <div class="form-group">
                    <label for="produto_id">Produto</label>
                    <select id="produto_id" class="form-control">
                        <option value="">Selecione o produto</option>
                        @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" id="quantidade" class="form-control" value="1" min="1">
                </div>

                <button type="button" class="btn btn-success" id="adicionar-produto-btn">Adicionar Produto</button>
            </div>
        </div>
    </div>

    <!-- Card 3: Forma de Pagamento e Data da Venda -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Forma de Pagamento </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="forma_pagamento">Forma de Pagamento</label>
                    <select id="forma_pagamento" class="form-control">
                        <option value="">--Selecione--</option>
                        <option value="pix">PIX</option>
                        <option value="cartao_credito">Cartão de Crédito</option>
                        <option value="boleto">Boleto</option>
                        <option value="boleto">Débito</option>
                        <option value="boleto">Dinheiro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="data_venda">Data da Venda</label>
                    <input type="date" id="data_venda" class="form-control" value="{{ date('Y-m-d') }}">
                </div>

                <button type="button" class="btn btn-primary" id="finalizar-venda-btn">Finalizar Venda</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para cadastrar novo cliente -->
<div class="modal fade" id="modalNovoCliente" tabindex="-1" role="dialog" aria-labelledby="modalNovoClienteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoClienteLabel">Cadastrar Novo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-novo-cliente">
                    <div class="form-group">
                        <label for="novo_cliente_nome">Nome</label>
                        <input type="text" id="novo_cliente_nome" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="novo_cliente_email">Email</label>
                        <input type="email" id="novo_cliente_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="novo_cliente_telefone">Telefone</label>
                        <input type="text" id="novo_cliente_telefone" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="salvar-novo-cliente-btn">Salvar Cliente</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
   $(document).ready(function() {
    // Função de busca de cliente ao clicar no botão "Buscar Cliente"
    $('#buscar-cliente-btn').on('click', function() {
        let clienteNome = $('#buscar_cliente').val();  // Captura o valor do campo de busca
        if (clienteNome.trim() === '') {
            alert('Por favor, digite um nome ou email para buscar.');
            return;
        }

        // Realiza a requisição AJAX para buscar o cliente
        $.ajax({
            url: "{{ route('clientes.autocomplete') }}",  // Rota que busca os clientes
            method: "GET",
            data: { term: clienteNome },
            success: function(data) {
                if (data.length > 0) {
                    // Exibe os dados do primeiro cliente encontrado
                    alert('Cliente encontrado: ' + data[0].nome + ' (' + data[0].email + ')');
                    $('#cliente_id').val(data[0].id);  // Atribui o ID do cliente ao campo hidden
                } else {
                    alert('Cliente não encontrado.');
                    $('#modalNovoCliente').modal('show');  // Exibe o modal para cadastrar um novo cliente
                }
            },
            error: function() {
                alert('Erro ao buscar cliente. Tente novamente.');
            }
        });
});
        // Ações do botão adicionar novo cliente
        $('#salvar-novo-cliente-btn').on('click', function() {
            let nome = $('#novo_cliente_nome').val();
            let email = $('#novo_cliente_email').val();
            let telefone = $('#novo_cliente_telefone').val();

            // Envia requisição AJAX para salvar novo cliente
            $.ajax({
                url: "{{ route('clientes.store') }}",
                method: "POST",
                data: {
                    nome: nome,
                    email: email,
                    telefone: telefone,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert('Cliente cadastrado com sucesso!');
                    $('#modalNovoCliente').modal('hide');
                },
                error: function(response) {
                    alert('Erro ao cadastrar o cliente');
                }
            });
        });

        // Ações do botão adicionar produto
        $('#adicionar-produto-btn').on('click', function() {
            let produtoId = $('#produto_id').val();
            let quantidade = $('#quantidade').val();

            // Adicionar produto à lista (logicamente, precisaria de mais ajustes para fazer isso visualmente)
            console.log('Produto ID: ' + produtoId + ', Quantidade: ' + quantidade);
        });

        // Ações do botão finalizar venda
        $('#finalizar-venda-btn').on('click', function() {
            let formaPagamento = $('#forma_pagamento').val();
            let dataVenda = $('#data_venda').val();
            // Finalizar venda
            console.log('Forma de Pagamento: ' + formaPagamento + ', Data da Venda: ' + dataVenda);
        });
    });
</script>
@stop