<?php

namespace App\Http\Controllers;

use App\Models\Rifa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PrincipalController extends Controller
{
    const canPorPagina = 20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vendedor = $request->session()->get('Vendedor');
        $identificacion = $request->session()->get('Identificacion');
        return Inertia::render('Principal/Index', ['Vendedor' => $vendedor[0], 'Identificacion' => $identificacion[0]]);
    }
}
