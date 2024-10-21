<?php


namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\NomeCrianca;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    // Método para listar as vendas
    public function index()
    {
        // Recupera todas as vendas do banco de dados
        $vendas = Venda::with('produtos', 'nomesCriancas')->get();

        // Retorna a view de listagem de vendas e passa os dados para ela
        return view('vendas.index', compact('vendas'));
    }

    public function store(Request $request)
    {
        // Verificar se um novo cliente foi adicionado
        if ($request->filled('novo_cliente_nome')) {
            $cliente = Cliente::create([
                'nome' => $request->novo_cliente_nome,
                'email' => $request->novo_cliente_email,
                'telefone' => $request->novo_cliente_telefone,
            ]);
            $cliente_id = $cliente->id;
        } else {
            $cliente_id = $request->cliente_id;
        }
    
        // Criar a venda
        $venda = Venda::create([
            'cliente_id' => $cliente_id,
            'valor_total' => $request->valor_total,
            'status' => $request->status,
        ]);
    
        foreach ($request->criancas as $criancaData) {
            NomeCrianca::create([
                'venda_id' => $venda->id,
                'nome_crianca' => $criancaData['nome_crianca'],
                'produto_id' => $criancaData['produto_id'],
                'quantidade' => $criancaData['quantidade'],
            ]);
        }
        return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
    }
    
    public function create()
    {
        $produtos = Produto::all(); // Carrega os produtos
        return view('vendas.create', compact('produtos'));
    }
}
