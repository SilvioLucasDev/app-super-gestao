<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use Illuminate\Http\Request;
use App\Models\SiteContato;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {
        $motivo_contatos = MotivoContato::all();
        $titulo = 'Contato';
        return view('site.contato', compact('titulo', 'motivo_contatos'));
    }

    public function salvar(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ];
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'email' => 'O :attribute informado não é válido'
        ];
        $request->validate($regras, $feedback);
        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
