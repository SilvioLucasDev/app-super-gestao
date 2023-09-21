<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(Request $request)
    {
        $titulo = 'Fornecedor';
        return view('app.fornecedor', compact('titulo'));
    }
}
