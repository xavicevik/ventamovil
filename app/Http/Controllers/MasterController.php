<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Departamento;
use App\Models\Localidad;
use App\Models\Loteria;
use App\Models\Restriccion;
use App\Models\Segmentos;
use App\Models\TiposCliente;
use App\Models\TiposDocumento;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MasterController extends Controller
{
    protected $url = null;

    public function __construct() {
        $this->url = config('edatel.serviceurl');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTiposdocumento(Request $request)
    {
        $datos = TiposDocumento::where('estado', 1)->get();
        return ['data' => $datos];
    }

    public function getTipoCliente(Request $request)
    {
        $datos = TiposCliente::where('estado', 1)->get();
        return ['data' => $datos];
    }

    public function getSegmentos(Request $request)
    {
        $datos = Segmentos::where('estado', 1)->get();
        return ['data' => $datos];
    }

    public function getRestricciones(Request $request)
    {
        $datos = Restriccion::where('estado', 1)->get();
        return ['data' => $datos];
    }


    public function getDepartamentos(Request $request)
    {
        $datos = Departamento::where('estado', 1)->get();
        return ['data' => $datos];
    }

    public function getLocalidadDepartamento(Request $request)
    {
        $datos = Localidad::where('ID_PADRE', $request->departamento)->get();
        return ['data' => $datos];
    }

    public function getBarrioLocalidad(Request $request)
    {
        $localidad = $request->session()->get('localidad');
        $datos = Barrio::where('ID_PADRE', $localidad[0])->get();

        return ['data' => $datos];
    }

}
