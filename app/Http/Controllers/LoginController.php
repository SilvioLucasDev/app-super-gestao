<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';
        if ($request->get('erro') == 1) $erro = 'Usuário e ou senha inválidos';
        if ($request->get('erro') == 2) $erro = 'Necessário realizar login para ter acesso a página';
        return view('site.login', compact('erro'));
    }

    public function autenticar(Request $request)
    {
        $regras = [
            'usuario' => 'email',
            'senha' => 'required',
        ];
        $feedback = [
            'email' => 'O :attribute informado não é válido',
            'required' => 'O campo :attribute deve ser preenchido'
        ];
        $request->validate($regras, $feedback);
        $email = $request->get('usuario');
        $password = $request->get('senha');
        $usuario = new User();
        $usuario_existe = $usuario->where('email', $email)->where('password', $password)->get()->first();
        if (!isset($usuario_existe)) return redirect()->route('site.login', ['erro' => 1]);
        session_start();
        $_SESSION['nome'] = $usuario_existe->name;
        $_SESSION['email'] = $usuario_existe->email;
        return redirect()->route('cliente.index');
    }

    public function sair()
    {
        session_destroy();
        return redirect()->route('site.index');
    }
}
