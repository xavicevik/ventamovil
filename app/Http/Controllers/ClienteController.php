<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Rifa;
use App\Models\Rol;
use App\Models\User;
use App\Models\Vendedor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ClienteController extends Controller
{
    const canPorPagina = 20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Clientes/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255'],
            'idtipos_documento' => 'required|numeric|gt:0',
            'idpais' => 'required|numeric|gt:0',
            'iddepartamento' => 'required|numeric|gt:0',
            'idciudad' => 'required|numeric|gt:0',
            'idrol' => 'required|numeric|gt:0',
        ],
            [
                'nombre.required' => 'Ingrese el nombre',
                'apellido.required' => 'Ingrese el apellido',
                'correo.required' => 'Ingrese el correo',
                'telefono.required' => 'Ingrese el teléfono celular',
                'documento.required' => 'Ingrese el número de identificacion',
                'idtipos_documento.gt' => 'Seleccione una tipo de documento',
                'idpais.gt' => 'Seleccione un País',
                'iddepartamento.gt' => 'Seleccione un Departamento',
                'idrol.gt' => 'Seleccione un Rol',
                'idciudad.gt' => 'Seleccione una ciudad',
            ])->validate();

        $mytime= Carbon::now('America/Bogota');

        if ($request->idrol == 2) {
            $user = Cliente::create($request->all());
        } elseif ($request->idrol == 5) {
            $user = Vendedor::create($request->all());
        } else {
            $user = User::create($request->all());
        }

        if(!$request->cambiarpassword) {
            $user->changedpassword = $mytime->toDateString();
        } else {
            $user->changedpassword = null;
        }
        $user->password = Hash::make($user->password);
        $user->estado = true;

        $user->saveOrFail();

        $rol = Rol::where('id', $user->idrol)->first();
        //$user->assignRole($rol->nombre);

        if ($user->observaciones == 'Creado por movimiento de caja') {
            return ['user' => $user];
        } else {
            return redirect()->back()->with('message', 'Cliente creado satisfactoriamente');
        }
    }
}
