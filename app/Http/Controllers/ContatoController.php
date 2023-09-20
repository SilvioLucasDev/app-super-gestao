<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {
        $motivo_contatos = [
            '1' => 'Dúvida',
            '2' => 'Elogio',
            '3' => 'Reclamação',
        ];
        $titulo = 'Contato';
        return view('site.contato', compact('titulo', 'motivo_contatos'));
    }

    public function salvar(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contato' => 'required',
            'mensagem' => 'required|max:2000'
        ];
        $feedback = [
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'nome.unique' => 'O nome informado já está em uso',
            'email.email' => 'O e-mail informado não é válido',
            'mensagem.max' => 'A mensagem deve ter no máximo 200 caracteres',
            'required' => 'O campo :attribute deve ser preenchido'
        ];
        $request->validate($regras, $feedback);
        //SiteContato::create($request->all());
    }
}
