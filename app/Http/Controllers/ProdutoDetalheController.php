<?php

namespace App\Http\Controllers;

use App\Models\ProdutoDetalhe;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        $titulo = 'Detalhes do Produto';
        return view('app.produto-detalhe.create', compact('titulo', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'comprimento' => 'required',
            'largura' => 'required',
            'altura' => 'required',
            'unidade_id' => 'exists:unidades,id',
        ];
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'unidade_id.exists' => 'Unidade de medida inválida',
            'produto_id.exists' => 'Produto não encontrado',
        ];
        $request->validate($regras, $feedback);
        ProdutoDetalhe::create($request->all());
        echo "produto cadastrado";
        // return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProdutoDetalhe $produto_detalhe)
    {
        $unidades = Unidade::all();
        $titulo = 'Detalhes do Produto';
        return view('app.produto-detalhe.edit', compact('titulo', 'produto_detalhe', 'unidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProdutoDetalhe $produto_detalhe)
    {
        $produto_detalhe->update($request->all());
        echo "update realizado";
        // return redirect()->route('produto-detalhe.show', $produto_detalhe->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
