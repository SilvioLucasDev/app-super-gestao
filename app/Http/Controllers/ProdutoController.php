<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request = $request->all();
        $produtos = Produto::paginate(10);
        $titulo = 'Produto';
        return view('app.produto.index', compact('titulo', 'produtos', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        $titulo = 'Produto';
        return view('app.produto.create', compact('titulo', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
        ];
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'integer' => 'O campo :attribute deve ser um número inteiro',
            'unidade_id.exists' => 'Unidade de medida inválida',
        ];
        $request->validate($regras, $feedback);
        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        $titulo = 'Produto';
        return view('app.produto.show', compact('titulo', 'produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        $titulo = 'Produto';
        return view('app.produto.edit', compact('titulo', 'produto', 'unidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return redirect()->route('produto.show', $produto->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
