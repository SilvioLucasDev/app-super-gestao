<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function principal()
    {
        $titulo = 'Home';
        return view('site.principal', compact('titulo'));
    }
}
