<?php

namespace App\Http\Controllers;

use App\Models\Rifa;
use Illuminate\Http\Request;
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
        return Inertia::render('Principal/Index');
    }
}
