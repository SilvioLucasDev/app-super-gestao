<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index',);
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%' . $request->input('nome') . '%')
            ->where('site', 'like', '%' . $request->input('site') . '%')
            ->where('uf', 'like', '%' . $request->input('uf') . '%')
            ->where('email', 'like', '%' . $request->input('email') . '%')
            ->paginate(10);
        $request = $request->all();
        return view('app.fornecedor.listar', compact('fornecedores', 'request'));
    }

    public function adicionar(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->input('id');
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required',
                'email' => 'email|unique:fornecedores,email,' . $id,
            ];
            $feedback = [
                'unique' => 'O :attribute informado já está em uso',
                'required' => 'O campo :attribute deve ser preenchido',
                'min' => 'O campo :attribute precisa ter no mínimo :min caracteres',
                'max' => 'O campo :attribute deve ter no máximo :max caracteres',
                'email' => 'O :attribute informado não é válido'
            ];
            $request->validate($regras, $feedback);
            if (empty($id)) {
                $id = Fornecedor::insertGetId($request->except('_token'));
                $msg = 'Cadastro realizado com sucesso';
            } else {
                $fornecedor = Fornecedor::find($id);
                $update = $fornecedor->update($request->all());
                $msg = $update ? 'Atualização realizada com sucesso' : 'Erro ao tentar atualizar o registro';
            }
            return redirect()->route('app.fornecedor.editar', compact('id', 'msg'));
        }
        return view('app.fornecedor.adicionar');
    }

    public function editar(String $id, String $msg = '')
    {
        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', compact('fornecedor', 'msg'));
    }

    public function excluir(String $id)
    {
        Fornecedor::find($id)->delete();
        return redirect()->route('app.fornecedor');
    }
}
