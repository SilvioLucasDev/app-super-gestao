<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $titulo = 'Produto';
        return view('app.produto', compact('titulo'));
    }
}
