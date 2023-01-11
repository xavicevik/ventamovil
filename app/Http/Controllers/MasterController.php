<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Boleta;
use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Localidad;
use App\Models\Loteria;
use App\Models\Pais;
use App\Models\Restriccion;
use App\Models\Rol;
use App\Models\Segmentos;
use App\Models\Serie;
use App\Models\Terminosycondiciones;
use App\Models\TiposCliente;
use App\Models\TiposDocumento;
use App\Models\User;
use App\Models\Vendedor;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MasterController extends Controller
{
    const canPorPagina = 10;
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
        /*
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($this->url, [
                "ListaVal" => 'l1574_71p0id3n7'
            ]);

        return ['data' => $response->json(), 'status' => $response->status()];
        */

        $datos = TiposDocumento::where('estado', 1)->get();
        return ['data' => $datos];
    }

    public function getTipoCliente(Request $request)
    {
        /*
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($this->url, [
                "ListaVal" => 'Li574_71p0Cl13n7e'
            ]);

        return ['data' => $response->json(), 'status' => $response->status()];
        */
        $datos = TiposCliente::where('estado', 1)->get();
        return ['data' => $datos];
    }

    public function getSegmentos(Request $request)
    {
        /*
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($this->url, [
                "ListaVal" => 'l1574_S36M3nT4c1oNCl13nte'
            ]);

        return ['data' => $response->json(), 'status' => $response->status()];
        */
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








    public function rolesIndex(Request $request)
    {
    $buscar = $request->buscar;
    if ($request->has('sortBy') && $request->sortBy <> ''){
        $sortBy = $request->sortBy;
    } else {
        $sortBy = 'id';
    }

    if ($request->has('sortOrder') && $request->sortOrder <> ''){
        $sortOrder = $request->sortOrder;
    } else {
        $sortOrder = 'desc';
    }

    if ($buscar == ''){
        $roles = Role::orderBy($sortBy, $sortOrder)
            ->paginate(self::canPorPagina);
    } else {
        $roles = Role::orderBy($sortBy, $sortOrder)
            ->where('name', 'like', '%'. $buscar . '%')
            ->paginate(self::canPorPagina);
    }

    if ($request->has('ispage') && $request->ispage){
        return ['data' => $roles];
    } else {
        return Inertia::render('Masters/RolesIndex', ['data' => $roles]);
    }
}

    public function rolesshow(Request $request)
    {
        $role = Role::find($request->id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $request->id)->paginate(10);

        return ['role' => $role, 'rolePermissions' => $rolePermissions];
    }

    public function rolesedit(Request $request)
    {
        $role = Role::find($request->id);
        $permission = Permission::paginate(100);
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $request->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        $rolepermtemp = [];
        $rolepermtemp2[] = [];
        if ($rolePermissions) {
            foreach ($rolePermissions as $p) {
                $rolepermtemp[] = $p;
            }
        }

        /*
        foreach ($permission as $p => $val) {
            if (isset($rolePermissions[$p])) {
                $rolepermtemp2[$p] = $rolePermissions[$p]?$rolePermissions[$p]:0;
            } else {
                $rolepermtemp2[$p] = 0;
            }
        }
        */

        return ['role' => $role,
            'permission' => $permission,
            'rolePermissions' => $rolePermissions,
            'rolePermissionsjson'=> $rolepermtemp,
            '_token' => csrf_token()
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function rolesupdate(Request $request)
    {
        $role = Role::where('id', $request->idrol)->first();
        $role->revokePermissionTo(Permission::all());

        foreach ($request->all() as $key => $value) {
            if ($key != 'idrol') {
                $permiso[] = Permission::where("id", $key)->get();
            }
        }
        $role->syncPermissions($permiso);

        return redirect()->back()->with('message', 'Permisos actualizados correctamente');
    }

    public function paisesIndex(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        if ($request->has('sortBy') && $request->sortBy <> ''){
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        if ($request->has('sortOrder') && $request->sortOrder <> ''){
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        if ($buscar == ''){
            $paises = Pais::orderBy($sortBy, $sortOrder)
                            ->with('departamentos.ciudades')
                            ->paginate(self::canPorPagina);
        } else {
            $paises = Pais::orderBy($sortBy, $sortOrder)
                            ->with('departamentos.ciudades')
                            ->where('nombre', 'like', '%'. $buscar . '%')
                            ->paginate(self::canPorPagina);
        }

        if ($request->has('ispage') && $request->ispage){
            return ['data' => $paises];
        } else {
            return Inertia::render('Masters/PaisesIndex', ['data' => $paises]);
        }
    }

    public function seriesIndex(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        if ($request->has('sortBy') && $request->sortBy <> ''){
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        if ($request->has('sortOrder') && $request->sortOrder <> ''){
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        if ($buscar == ''){
            $series = Serie::orderBy($sortBy, $sortOrder)
                ->paginate(self::canPorPagina);
        } else {
            $series = Serie::orderBy($sortBy, $sortOrder)
                ->where('nombre', 'like', '%'. $buscar . '%')
                ->paginate(self::canPorPagina);
        }

        if ($request->has('ispage') && $request->ispage){
            return ['data' => $series];
        } else {
            return Inertia::render('Masters/SeriesIndex', ['data' => $series]);
        }
    }

    public function empresasIndex(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        if ($request->has('sortBy') && $request->sortBy <> ''){
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        if ($request->has('sortOrder') && $request->sortOrder <> ''){
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        if ($buscar == ''){
            $empresas = Empresa::orderBy($sortBy, $sortOrder)
                ->with('tipodocumento')
                ->with('ciudad')
                ->with('tipoempresa')
                ->with('mayoristas')
                ->with('distribuidores')
                ->with('vendedores')
                ->with('padre')
                ->with('hijos.tipoempresa')
                ->with('hijos.ciudad')
                ->with('hijos.hijos.tipoempresa')
                ->with('hijos.hijos.ciudad')
                ->paginate(self::canPorPagina);
        } else {
            $empresas = Empresa::orderBy($sortBy, $sortOrder)
                ->where('nombre', 'like', '%'. $buscar . '%')
                ->with('tipodocumento')
                ->with('ciudad')
                ->with('tipoempresa')
                ->with('mayoristas')
                ->with('distribuidores')
                ->with('vendedores')
                ->with('padre')
                ->with('hijos.tipoempresa')
                ->with('hijos.ciudad')
                ->with('hijos.hijos.tipoempresa')
                ->with('hijos.hijos.ciudad')
                ->paginate(self::canPorPagina);
        }

        if ($request->has('ispage') && $request->ispage){
            return ['data' => $empresas];
        } else {
            return Inertia::render('Masters/EmpresasIndex', ['data' => $empresas]);
        }
    }



    public function terminosIndex(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        if ($request->has('sortBy') && $request->sortBy <> ''){
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        if ($request->has('sortOrder') && $request->sortOrder <> ''){
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        if ($buscar == ''){
            $terminos = Terminosycondiciones::orderBy($sortBy, $sortOrder)
                ->paginate(self::canPorPagina);
        } else {
            $terminos = Terminosycondiciones::orderBy($sortBy, $sortOrder)
                ->where('nombre', 'like', '%'. $buscar . '%')
                ->paginate(self::canPorPagina);
        }

        if ($request->has('ispage') && $request->ispage){
            return ['data' => $terminos];
        } else {
            return Inertia::render('Masters/TerminosIndex', ['data' => $terminos]);
        }
    }

    public function tipodocSearch(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        if ($request->has('sortBy') && $request->sortBy <> ''){
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        if ($request->has('sortOrder') && $request->sortOrder <> ''){
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        if ($buscar == ''){
            $tipos = TiposDocumento::orderBy($sortBy, $sortOrder)
                                    ->get();
        } else {
            $tipos = TiposDocumento::orderBy($sortBy, $sortOrder)
                                    ->where('nombre', 'like', '%'. $buscar . '%')
                                    ->get();
        }

        return ['data' => $tipos];

    }

    public function getRoles(Request $request)
    {
        if(Auth::user()->idrol == 1 || Auth::user()->idrol == 6) {
            $roles = Rol::all();
        } else {
            $roles = Rol::where('id', '<>', 1)
                        ->where('id', '<>', 6)
                        ->get();
        }
        return ['data' => $roles];
    }

    public function getEmpresas(Request $request)
    {
        $estado = $request->estado;

        if($request->has('estado') && $estado == 2) {
            $empresas = Vendedor::join('empresas', 'vendedors.idempresa', '=', 'empresas.id')
                              ->where('vendedors.idrol', 5)
                              ->where('empresas.idpadre', $request->idpadre)
                              ->select('vendedors.id as id', DB::raw('CONCAT(vendedors.nombre, " ", vendedors.apellido) AS razon_social'))
                              ->get();
        } else {
            if (!$request->has('idpadre')) {
                switch ($request->idrol) {
                    case 1:
                        $empresas = Empresa::where('id', 3)->get();
                        break;
                    case 2:
                        $empresas = Empresa::where('id', 3)->get();
                        break;
                    case 3:
                        $empresas = Empresa::where('idtipoempresa', 2)->get();
                        break;
                    case 4:
                        $empresas = Empresa::where('idtipoempresa', 1)->get();
                        break;
                    case 5:
                        $empresas = Empresa::where('idtipoempresa', 3)->get();
                        break;
                    default:
                        $empresas = Empresa::all();
                        break;
                }
            } else {
                switch ($request->idrol) {
                    case 1:
                        $empresas = Empresa::where('id', 3)->where('idpadre', $request->idpadre)->get();
                        break;
                    case 2:
                        $empresas = Empresa::where('id', 3)
                            ->where('idpadre', $request->idpadre)
                            ->get();
                        break;
                    case 3:
                        $empresas = Empresa::where('idtipoempresa', 2)->where('idpadre', $request->idpadre)->get();
                        break;
                    case 4:
                        $empresas = Empresa::where('idtipoempresa', 1)->where('idpadre', $request->idpadre)->get();
                        break;
                    case 5:
                        $empresas = Empresa::where('idtipoempresa', 3)->where('idpadre', $request->idpadre)->get();
                        break;
                    default:
                        $empresas = Empresa::all();
                        break;
                }
            }
        }

        return ['data' => $empresas];
    }

    public function loterias(Request $request)
    {
        $loterias =  Loteria::all();

        return ['loterias' => $loterias];
    }

    public function terminos(Request $request)
    {
        $terminos =  Terminosycondiciones::all();

        return ['terminos' => $terminos];
    }

    public function getDashboard(Request $request)
    {
        $boletasdisponibles = Boleta::where('1')->get()->count();;

        return ['terminos' => $boletasdisponibles];
    }

}
