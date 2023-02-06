<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PrincipalController extends Controller
{
    public function index(Request $request)
    {
        $vendedor = $request->session()->get('Vendedor');
        $identificacion = $request->session()->get('Identificacion');
        return Inertia::render('Principal/Index', ['Vendedor' => $vendedor[0], 'Identificacion' => $identificacion[0]]);
    }
}
