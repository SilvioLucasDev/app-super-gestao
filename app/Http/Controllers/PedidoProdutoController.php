<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
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
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        return view('app.pedido-produto.create', compact('pedido', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required|integer',
        ];
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'integer' => 'O campo :attribute deve ser um número inteiro',
            'produto_id.exists' => 'Produto inválido',
        ];
        $request->validate($regras, $feedback);
        $pedido->produtos()->attach([
            $request->get('produto_id') => ['quantidade' => $request->get('quantidade')]
        ]);
        return redirect()->route('pedido-produto.create', $pedido->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(PedidoProduto $pedido_produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PedidoProduto $pedido_produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PedidoProduto $pedido_produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PedidoProduto $pedido_produto)
    {
        $pedido_produto->delete();
        return redirect()->route('pedido-produto.create', $pedido_produto->pedido_id);
    }
}
