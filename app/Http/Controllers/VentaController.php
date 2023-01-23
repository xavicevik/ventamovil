<?php

namespace App\Http\Controllers;

use App\Events\RealTimeMessage;
use App\Events\SaleApp;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSMSJob;
use App\Models\Archivo;
use App\Models\Barrio;
use App\Models\Boleta;
use App\Models\Caja;
use App\Models\Checkout;
use App\Models\Ciclo;
use App\Models\Cliente;
use App\Models\Comision;
use App\Models\Confcomision;
use App\Models\Configuración;
use App\Models\Detallesesion;
use App\Models\Detalleventa;
use App\Models\Estado;
use App\Models\Estrato;
use App\Models\Historialcaja;
use App\Models\Loteria;
use App\Models\Imagen;
use App\Models\Militante;
use App\Models\Pago;
use App\Models\Paquetetv;
use App\Models\Paquetevoz;
use App\Models\Promoboleta;
use App\Models\Promocional;
use App\Models\Recibo;
use App\Models\Restriccion;
use App\Models\Rifa;
use App\Models\Segmentos;
use App\Models\Sesionventa;
use App\Models\Tecnologia;
use App\Models\TiposCliente;
use App\Models\TiposDocumento;
use App\Models\Transaccion;
use App\Models\User;
use App\Models\Vendedor;
use App\Models\Venta;
use App\Models\Whmercadopago;
use App\Notifications\EmailcodeNotification;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notification;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;
use Spatie\Permission\Models\Permission;
use function PHPUnit\Framework\isEmpty;


class VentaController extends Controller
{
    function __construct()
    {
        /*
        $this->middleware('permission:ventas-list|ventas-create|ventas-edit|ventas-delete', ['only' => ['index','show']]);
        $this->middleware('permission:ventas-create', ['only' => ['create','store']]);
        $this->middleware('permission:ventas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ventas-delete', ['only' => ['destroy']]);
        */
        //$this->middleware(['role:Administrador','permission:ventas-list']);
        //$this->middleware('permission:ventas-list|ventas-create|ventas-edit|ventas-delete', ['only' => ['index','show']]);
    }

    const canPorPagina = 10;
    const debito = 'DB';
    const credito = 'CR';
    const pago = 'PA';
    // lista de estados
    const inactivo = 0;
    const activo = 1;
    const reservado = 2;
    const vendido = 3;
    const pendiente = 4;
    const enproceso = 5;
    const cancelado = 6;
    const anulado = 9;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vendedor = $request->session()->get('Vendedor');
        $identificacion = $request->session()->get('Identificacion');
        $localidad = $request->session()->get('localidad');
        $localidaddesc = $request->session()->get('localidaddesc');
        return Inertia::render('Ventas/Index', [
            'Vendedor' => $vendedor[0],
            'Identificacion' => $identificacion[0],
            'localidad' => $localidad[0],
            'localidaddesc' => $localidaddesc[0]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $vendedor = $request->session()->get('Vendedor');
        $identificacion = $request->session()->get('Identificacion');
        $localidad = $request->session()->get('localidad');
        $localidaddesc = $request->session()->get('localidaddesc');
        $cilos = Ciclo::where('estado', 1)->get();
        $estratos = Estrato::where('estado', 1)->get();
        $segmentos = Segmentos::where('estado', 1)->get();
        $barrios = Barrio::where('estado', 1)->get();
        $tipoclientes = TiposCliente::where('estado', 1)->get();
        $tipoidentificaciones = TiposDocumento::where('estado', 1)->get();
        $tecnologias = Tecnologia::where('estado', 1)->get();
        $restricciones = Restriccion::where('estado', 1)->get();
        $paquetesvoz = Paquetevoz::where('estado', 1)->get();
        $paquetestv = Paquetetv::where('estado', 1)->get();

        return Inertia::render('Ventas/Crear', [
            'Vendedor' => $vendedor[0],
            'Identificacion' => $identificacion[0],
            'localidad' => $localidad[0],
            'localidaddesc' => $localidaddesc[0],
            'ciclos' => $cilos,
            'estratos' => $estratos,
            'barrios' => $barrios,
            'segmentos' => $segmentos,
            'tipoclientes' => $tipoclientes,
            'tipoidentificaciones' =>  $tipoidentificaciones,
            'tecnologias' => $tecnologias,
            'restricciones' => $restricciones,
            'paquetesvoz' => $paquetesvoz,
            'paquetestv' => $paquetestv
        ]);
    }

    public function changeSpeed(Request $request)
    {
        $vendedor = $request->session()->get('Vendedor');
        $identificacion = $request->session()->get('Identificacion');
        $localidad = $request->session()->get('localidad');
        $localidaddesc = $request->session()->get('localidaddesc');
        $cilos = Ciclo::where('estado', 1)->get();
        $estratos = Estrato::where('estado', 1)->get();
        $segmentos = Segmentos::where('estado', 1)->get();
        $barrios = Barrio::where('estado', 1)->get();
        $tipoclientes = TiposCliente::where('estado', 1)->get();
        $tipoidentificaciones = TiposDocumento::where('estado', 1)->get();
        $tecnologias = Tecnologia::where('estado', 1)->get();
        $restricciones = Restriccion::where('estado', 1)->get();
        $paquetesvoz = Paquetevoz::where('estado', 1)->get();
        $paquetestv = Paquetetv::where('estado', 1)->get();

        return Inertia::render('Ventas/Cambiovelocidad', [
            'Vendedor' => $vendedor[0],
            'Identificacion' => $identificacion[0],
            'localidad' => $localidad[0],
            'localidaddesc' => $localidaddesc[0],
            'ciclos' => $cilos,
            'estratos' => $estratos,
            'barrios' => $barrios,
            'segmentos' => $segmentos,
            'tipoclientes' => $tipoclientes,
            'tipoidentificaciones' =>  $tipoidentificaciones,
            'tecnologias' => $tecnologias,
            'restricciones' => $restricciones,
            'paquetesvoz' => $paquetesvoz,
            'paquetestv' => $paquetestv
        ]);
    }

    public function empaquetar(Request $request)
    {
        $vendedor = $request->session()->get('Vendedor');
        $identificacion = $request->session()->get('Identificacion');
        $localidad = $request->session()->get('localidad');
        $localidaddesc = $request->session()->get('localidaddesc');
        $cilos = Ciclo::where('estado', 1)->get();
        $estratos = Estrato::where('estado', 1)->get();
        $segmentos = Segmentos::where('estado', 1)->get();
        $barrios = Barrio::where('estado', 1)->get();
        $tipoclientes = TiposCliente::where('estado', 1)->get();
        $tipoidentificaciones = TiposDocumento::where('estado', 1)->get();
        $tecnologias = Tecnologia::where('estado', 1)->get();
        $restricciones = Restriccion::where('estado', 1)->get();
        $paquetesvoz = Paquetevoz::where('estado', 1)->get();
        $paquetestv = Paquetetv::where('estado', 1)->get();

        return Inertia::render('Ventas/Empaquetar', [
            'Vendedor' => $vendedor[0],
            'Identificacion' => $identificacion[0],
            'localidad' => $localidad[0],
            'localidaddesc' => $localidaddesc[0],
            'ciclos' => $cilos,
            'estratos' => $estratos,
            'barrios' => $barrios,
            'segmentos' => $segmentos,
            'tipoclientes' => $tipoclientes,
            'tipoidentificaciones' =>  $tipoidentificaciones,
            'tecnologias' => $tecnologias,
            'restricciones' => $restricciones,
            'paquetesvoz' => $paquetesvoz,
            'paquetestv' => $paquetestv
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = json_decode($request->XmlVenta);
        $vendedor = $request->session()->get('Vendedor');
        $localidad = $request->session()->get('localidad');

        $datos->EMPAQUETAR = valTrue($datos->EMPAQUETAR)?'Y':'N';
        $datos->INC_VOZ = valTrue($datos->INC_VOZ)?'Y':'N';
        $datos->INC_INT = valTrue($datos->INC_INT)?'Y':'N';
        $datos->INC_TV = valTrue($datos->INC_TV)?'Y':'N';
        $datos->LOCALIDAD = $localidad[0];
        $datos->LOCALIDAD_COBR = $localidad[0];
        $datos->VENDEDOR = $vendedor[0];
        $datos->BARRIO = $datos->BARRIO==0?'':$datos->BARRIO;
        $datos->BARRIO_COBR = $datos->BARRIO_COBR==0?'':$datos->BARRIO_COBR;
        $datos->PAQUETE_SS = $datos->PAQUETE_SS==0?'':$datos->PAQUETE_SS;
        $datos->RETRICCION = $datos->RETRICCION==0?'':$datos->RETRICCION;
        $datos->DTH = valTrue($datos->DTH)?'Y':'N';
        $datos->NUMERO_PRIVADO = valTrue($datos->NUMERO_PRIVADO)?'Y':'N';
        $datos->CODVENTAS = $datos->VENDEDOR;

        if ($datos->INC_VOZ == 'N') {
            $datos->PLAN_CCIAL_LB = '';
            $datos->PLAN_VTA_LB = '';
        }
        if ($datos->INC_INT == 'N') {
            $datos->PLAN_CCIAL_INT = '';
            $datos->PLAN_VTA_INT = '';
        }
        if ($datos->INC_TV == 'N') {
            $datos->PLAN_CCIAL_TV = '';
            $datos->PLAN_VTA_TV = '';
        }

        $XmlVenta = stringtoXML($datos);

        //dd($XmlVenta);
        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'r3g1str4v3nt4',
                "XmlVenta" => $XmlVenta
            ]);

        //dd($response->body());
        //[103974493/0/0//1]

        $result = explode("/",$response->body());
        $solicitud = $result[0];
        $cun = $result[1];
        $codigo = $result[2];
        $mensaje = $result[3];
        $codventa = $result[3];

        return ['solicitud' => $solicitud, 'cun' => $cun, 'codigo' => $codigo, 'mensaje' => $mensaje, 'codventa' => $codventa];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDirInsta(Request $request)
    {
        $localidad = $request->session()->get('localidad');

        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "inuLocalidad" => $localidad[0],
                "ListaVal" => 'cr34D1r3cc10n',
                "isbDireccion" => $request->isbDireccion,
                "inuBarrio" => $request->inuBarrio==0?null:$request->inuBarrio
            ]);
        $result = explode(",",$response->body());
        $IdDireccion = $result[0];
        $Direcccion = $result[1];
        $mensaje = $result[2];

        return ['id' => $IdDireccion, 'direccion' => $Direcccion, 'mensaje' => $mensaje];
    }

    public function getComercialPlan(Request $request) {
        $localidad = $request->session()->get('localidad');

        $prod_voz = valTrue($request->prod_voz)?'Y':'N';
        $prod_int = valTrue($request->prod_int)?'Y':'N';
        $prod_tv = valTrue($request->prod_tv)?'Y':'N';
        $prod_empaquetado = $request->prod_empaquetado?'Y':'N';

        $filtro = " $localidad[0]";
        if ($request->estrato != 0) {
            $filtro .= " and estrato = $request->estrato";
        }
        if ($request->segmento != 0) {
            $filtro .= " and segmento = $request->segmento";
        }
        $filtro .= " and tipo_cliente = $request->tipo_cliente and prod_voz = '$prod_voz' and prod_int = '$prod_int' and prod_tv = '$prod_tv' and prod_empaquetado = '$prod_empaquetado' and TIPO_PRODUCTO in (1, 24, 8900, 6042)";
        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'l1574_Pl4nC14l',
                "Filtro" => json_encode($filtro)
            ]);

        //dd($response->collect()->where('TIPO_PRODUCTO', '=',1));
        $voz = $response->collect()->where('TIPO_PRODUCTO', '=',1);
        $int = $response->collect()->where('TIPO_PRODUCTO', '=',24);
        $tv = $response->collect()->whereIn('TIPO_PRODUCTO', [8900, 6042]);

        return ['planesvoz' => $voz, 'planesint' => $int, 'planestv' => $tv, 'status' => $response->status()];
    }

    public function getComercialPlanInd(Request $request) {
        $localidad = $request->session()->get('localidad');
        $prod_voz = 'N';
        $prod_int = 'N';
        $prod_tv = 'N';
        $prod_empaquetado = 'N';

        switch ($request->producto) {
            case 'voz':
                $prod_voz = 'Y';
                $tipoproducto = 1;
                breaK;
            case 'internet':
                $prod_int = 'Y';
                $tipoproducto = 24;
                break;
            case 'tv':
                $prod_tv = 'Y';
                $tipoproducto = '8900, 6042';
                break;
        }

        $filtro = " $localidad[0]";
        if ($request->estrato != 0) {
            $filtro .= " and estrato = $request->estrato";
        }
        if ($request->segmento != 0) {
            $filtro .= " and segmento = $request->segmento";
        }
        $filtro .= " and tipo_cliente = $request->tipo_cliente and prod_voz = '$prod_voz' and prod_int = '$prod_int' and prod_tv = '$prod_tv' and prod_empaquetado = '$prod_empaquetado' and TIPO_PRODUCTO in ($tipoproducto)";

        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'l1574_Pl4nC14l',
                "Filtro" => json_encode($filtro)
            ]);

        $planesind = $response->json();

        return ['planesind' => $planesind, 'status' => $response->status()];
    }

    public function getSalesPlan(Request $request) {
        $localidad = $request->session()->get('localidad');

        $filtro = " $localidad[0]";
        $filtro .= " and plan_comercial = $request->plancomercial";

        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'l1574_Pl4nV3nt4',
                "Filtro" => json_encode($filtro)
            ]);

        return ['planes' => $response->json(), 'status' => $response->status()];
    }

    public function getVelocidades(Request $request) {
        $localidad = $request->session()->get('localidad');

        $filtro = " $localidad[0]";
        $filtro .= " and Plan_comercial = $request->plancomercial";

        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'l1574_Cl4s3Svc10',
                "Filtro" => json_encode($filtro)
            ]);

        return ['planes' => $response->json(), 'status' => $response->status()];
    }

    public function getVelocidadesCambio(Request $request) {

        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'C0nsu_Cl4s_V3l0',
                "PLAN_ACTUAL" => $request->PLANFACT
            ]);

        return ['velocidades' => $response->json(), 'status' => $response->status()];
    }

    public function storeSpeed(Request $request)
    {
        $vendedor = $request->session()->get('Vendedor');

        $PRODUCTO_CAMVELOCIDAD = $request->PRODUCTO_CAMVELOCIDAD;
        $VELOCIDAD_NUEVA = $request->VELOCIDAD_NUEVA;

        $Xmlcambiovel = "<PRODUCTO_CAMVELOCIDAD>$PRODUCTO_CAMVELOCIDAD</PRODUCTO_CAMVELOCIDAD><VELOCIDAD_NUEVA>$VELOCIDAD_NUEVA</VELOCIDAD_NUEVA><VENDEDOR>$vendedor[0]</VENDEDOR>";

        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'R3gC4mb10V3l0c1d4d',
                "Xmlcambiovel" => $Xmlcambiovel
            ]);

        //[103974493/0/0//1]
        $result = explode("/",$response->body());
        $solicitud = $result[0];
        $cun = $result[1];
        $codigo = $result[2];
        $mensaje = $result[3];

        return ['solicitud' => $solicitud, 'cun' => $cun, 'codigo' => $codigo, 'mensaje' => $mensaje];
    }

    public function getComercialPlanPaq(Request $request) {

        $Producto = $request->Producto;
        $PlanCcialVoz = $request->PlanCcialVoz;
        $PlanCcialInt = $request->PlanCcialInt;
        $PlanCcialTV = $request->PlanCcialTV;

        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'c0nsult4Pl4nC14lP4q',
                "Filtro" => $Producto,
                "Filtro2" => null,
                "Filtro3" => $PlanCcialVoz,
                "Filtro4" => $PlanCcialInt,
                "Filtro5" => $PlanCcialTV
        ]);

        //dd($response->json());
        return ['planescomm' => $response->json(), 'status' => $response->status()];
    }

    public function storepaquete(Request $request)
    {
        $vendedor = $request->session()->get('Vendedor');

        $XmlPaquete =   "<PROD_VOZ>$request->PROD_VOZ</PROD_VOZ>" .
                        "<PROD_INT>$request->PROD_INT</PROD_INT>" .
                        "<PROD_TV>$request->PROD_TV</PROD_TV>" .
                        "<MOT_VTA_VOZ>$request->MOT_VTA_VOZ</MOT_VTA_VOZ>" .
                        "<MOT_VTA_INT>$request->MOT_VTA_INT</MOT_VTA_INT>" .
                        "<MOT_VTA_TV>$request->MOT_VTA_TV</MOT_VTA_TV>" .
                        "<PLAN_CCIAL_VOZ>$request->PLAN_CCIAL_VOZ</PLAN_CCIAL_VOZ>" .
                        "<PLAN_CCIAL_INT>$request->PLAN_CCIAL_INT</PLAN_CCIAL_INT>" .
                        "<PLAN_CCIAL_TV>$request->PLAN_CCIAL_TV</PLAN_CCIAL_TV>" .
                        "<PLAN_VTA_VOZ>$request->PLAN_VTA_VOZ</PLAN_VTA_VOZ>" .
                        "<PLAN_VTA_INT>$request->PLAN_VTA_INT</PLAN_VTA_INT>" .
                        "<PLAN_VTA_TV>$request->PLAN_VTA_TV</PLAN_VTA_TV>" .
                        "<VENDEDOR>$vendedor[0]</VENDEDOR>";

        dd($XmlPaquete);
        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'R3g3mp4qu4t4m13nt0',
                "XmlPaquete" => $XmlPaquete
            ]);

        //[103974493/0/0//1]
        $result = explode("/",$response->body());
        $solicitud = $result[0];
        $cun = $result[1];
        $codigo = $result[2];
        $mensaje = $result[3];

        return ['solicitud' => $solicitud, 'cun' => $cun, 'codigo' => $codigo, 'mensaje' => $mensaje];
    }


}
