<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    // Processar o login
    public function login(Request $request)
{


    // Validação do formulário de login
    $request->validate([
        'Email' => 'required|email',
        'Senha' => 'required|min:6',
    ]);

    // Verifica as credenciais no banco de dados
    $usuario = Usuario::where('Email', $request->Email)->first();
    if($usuario->Email == 'Admin@gmail.com' && Hash::check($request->Senha, $usuario->Senha)) {
        Auth::login($usuario);  // Realiza o login
        return redirect()->route('admin');
    }
    // Se o usuário existir e a senha for correta, faz o login
    if ($usuario && Hash::check($request->Senha, $usuario->Senha)) {
  // Redireciona para a página home após login
            Auth::login($usuario);  // Realiza o login
            return redirect()->route('inicio'); 
        
    } else {
        // Se as credenciais não forem válidas, retorna para a página anterior com erro
        return back()->withErrors(['Email' => 'Credenciais inválidas.']);
    }
}

    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    public function register(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'Nome' => 'required|string|max:120',
            'Email' => 'required|email|unique:USUARIO,Email',
            'Cpf' => 'required|digits:11|unique:USUARIO,Cpf',
            'Endereco' => 'nullable|string|max:255',
            'Senha' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Criar o usuário
        Usuario::create([
            'Nome' => $request->Nome,
            'Email' => $request->Email,
            'Cpf' => $request->Cpf,
            'Endereco' => $request->Endereco,
            'Senha' => Hash::make($request->Senha),
        ]);

        // Redirecionar após sucesso
        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Faça login.');
    }

    //logout do sistema
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalida a sessão do usuário para segurança adicional
        $request->session()->invalidate();

        // Gera um novo token CSRF
        $request->session()->regenerateToken();

        // Redireciona para a página de login ou outra página após o logout
        return redirect('/home')->with('message', 'Você saiu com sucesso.');
    }
}
