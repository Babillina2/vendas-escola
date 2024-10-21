<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        // Recuperar todos os usuários
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        // Exibir a view para criar um novo usuário
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        // Validar os dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Criar o usuário
        Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function edit(Usuario $usuario)
    {
        // Exibir a view para editar um usuário existente
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|min:6|confirmed', // A senha pode ser nula se não for alterada
        ]);
    
        // Atualizar o nome e email
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
    
        // Se o campo 'password' não estiver vazio, criptografa e atualiza a senha
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
    
        // Salvar as alterações
        $usuario->save();
    
        // Redirecionar com mensagem de sucesso
        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso.');
    }
    

    public function destroy(Usuario $usuario)
    {
        // Excluir o usuário
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuário excluído com sucesso.');
    }
}
