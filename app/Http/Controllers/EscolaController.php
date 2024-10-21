<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use Illuminate\Http\Request;

class EscolaController extends Controller
{
    // Método para exibir a tela de criação
    public function create()
    {
        return view('escolas.create');
    }

    public function index()
    {
        // Recuperar todas as escolas do banco de dados
        $escolas = Escola::all();

        // Retornar a view de listagem de escolas
        return view('escolas.index', compact('escolas'));
    }
    // Método para salvar a escola no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'responsavel' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'cnpj' => 'nullable|string|max:20',
        ]);

        // Criar a escola no banco de dados
        Escola::create($request->all());

        // Redirecionar após o cadastro com uma mensagem de sucesso
        return redirect()->route('escolas.index')->with('success', 'Escola cadastrada com sucesso.');
    }

    // Método para exibir a tela de edição
    public function edit(Escola $escola)
    {
        return view('escolas.edit', compact('escola'));
    }

    // Método para atualizar a escola no banco de dados
    public function update(Request $request, Escola $escola)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'responsavel' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'cnpj' => 'nullable|string|max:20',
        ]);

        // Atualizar os dados da escola no banco de dados
        $escola->update($request->all());

        // Redirecionar após a atualização com uma mensagem de sucesso
        return redirect()->route('escolas.index')->with('success', 'Escola atualizada com sucesso.');
    }
}
