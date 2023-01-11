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
            'restricciones' => $restricciones
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

        $XmlVenta = stringtoXML($datos);
        $XmlVenta .= "<VENDEDOR>$vendedor[0]</VENDEDOR>";
        $XmlVenta .= "<LOCALIDAD>$localidad[0]</LOCALIDAD>";
        $XmlVenta .= "<LOCALIDAD_COBR>$localidad</LOCALIDAD_COBR>";

        dd($XmlVenta);

        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'r3g1str4v3nt4',
                "XmlVenta" => $XmlVenta
            ]);

        $result = explode("/",$response->body());
        $idcliente = $result[0];
        $identificacion = $result[1];
        $codigo = $result[2];
        $mensaje = $result[3];

        return ['id' => $idcliente, 'identificacion' => $identificacion, 'codigo' => $codigo, 'mensaje' => $mensaje];
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

        $prod_voz = $request->prod_voz?'Y':'N';
        $prod_int = $request->prod_int?'Y':'N';
        $prod_tv = $request->prod_tv?'Y':'N';
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

}
