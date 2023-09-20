<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function principal()
    {
        $motivo_contatos = MotivoContato::all();
        $titulo = 'Home';
        return view('site.principal', compact('titulo', 'motivo_contatos'));
    }
}
