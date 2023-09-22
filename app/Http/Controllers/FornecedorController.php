<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(Request $request)
    {
        $titulo = 'Fornecedor';
        return view('app.fornecedor.index', compact('titulo'));
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::where('nome', 'like', '%' . $request->input('nome') . '%')
        ->where('site', 'like', '%' . $request->input('site') . '%')
        ->where('uf', 'like', '%' . $request->input('uf') . '%')
        ->where('email', 'like', '%' . $request->input('email') . '%')
        ->paginate(10);
        $request = $request->all();
        $titulo = 'Fornecedor';
        return view('app.fornecedor.listar', compact('titulo', 'fornecedores', 'request'));
    }

    public function adicionar(Request $request)
    {
        $msg = '';
        if ($request->getMethod() === 'POST') {
            if ($request->input('id') === '') {
                $regras = [
                    'nome' => 'required|min:3|max:40',
                    'site' => 'required',
                    'uf' => 'required',
                    'email' => 'email|unique:fornecedores',
                ];
                $feedback = [
                    'unique' => 'O :attribute informado já está em uso',
                    'required' => 'O campo :attribute deve ser preenchido',
                    'min' => 'O campo :attribute precisa ter no mínimo :min caracteres',
                    'max' => 'O campo :attribute deve ter no máximo :max caracteres',
                    'email' => 'O :attribute informado não é válido'
                ];
                $request->validate($regras, $feedback);
                $fornecedor = new Fornecedor();
                $fornecedor->create($request->all());
                $msg = 'Cadastro realizado com sucesso';
            }
            $id = $request->input('id');
            $fornecedor = Fornecedor::find($id);
            $update = $fornecedor->update($request->all());
            $msg = $update ? 'Atualização realizada com sucesso' : 'Erro ao tentar atualizar o registro';
            return redirect()->route('app.fornecedor.editar', compact('id', 'msg'));
        }
        $titulo = 'Fornecedor';
        return view('app.fornecedor.adicionar', compact('titulo', 'msg'));
    }

    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);
        $titulo = 'Fornecedor';
        return view('app.fornecedor.adicionar', compact('titulo', 'fornecedor', 'msg'));
    }

    public function excluir($id)
    {
        Fornecedor::find($id)->delete();
        return redirect()->route('app.fornecedor');
    }
}
