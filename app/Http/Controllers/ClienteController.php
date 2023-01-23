<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Rifa;
use App\Models\Rol;
use App\Models\Segmentos;
use App\Models\TiposCliente;
use App\Models\User;
use App\Models\Vendedor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use function PHPUnit\Framework\isNull;

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
        $vendedor = $request->session()->get('Vendedor');
        $identificacion = $request->session()->get('Identificacion');
        return Inertia::render('Clientes/Index', ['Vendedor' => $vendedor[0], 'Identificacion' => $identificacion[0]]);
    }

    public function getCliente(Request $request)
    {
        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'c0nsult4Ct3',
                "TIPO_IDENT" => $request->tipoident,
                "TIPO_CTE" => $request->tipocliente,
                "IDENTIFICACION" => $request->identificacion
            ]);

        $segmento = null;
        $tipocliente = null;
        if ($response->json()) {
            $segmento = Segmentos::where('CODIGO', $response->json([0])['SEGMENTO'])->first();
            $tipocliente = TiposCliente::where('CODIGO', $request->tipocliente)->first();
        }

        return [
            'data' => $response->json(),
            'status' => $response->status(),
            'segmento' => valTrue($segmento)?$segmento->DESCRIPCION:'',
            'tipocliente' => valTrue($tipocliente)?$tipocliente->DESCRIPCION:''
            ];
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
        return Inertia::render('Clientes/Crear', [
            'Vendedor' => $vendedor[0],
            'Identificacion' => $identificacion[0]
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
        $datos = json_decode($request->Xmlcliente);
        $vendedor = $request->session()->get('Vendedor');

        $Xmlcliente = stringtoXML($datos);
        $Xmlcliente .= "<VENDEDOR>$vendedor[0]</VENDEDOR>";
        $Xmlcliente .= '<MEDIO_RECEPCION>15</MEDIO_RECEPCION>';

        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'cr34cl13nt3',
                "Xmlcliente" => $Xmlcliente
            ]);

        $result = explode("/",$response->body());
        $idcliente = $result[0];
        $identificacion = $result[1];
        $codigo = $result[2];
        $mensaje = $result[3];

        return ['id' => $idcliente, 'identificacion' => $identificacion, 'codigo' => $codigo, 'mensaje' => $mensaje];
    }

    public function getContrato(Request $request)
    {
        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'l1574_C0nt4V3l',
                "Filtro" => $request->contrato
            ]);

        return [
            'data' => $response->json(),
            'contrato' => $response->json([0]),
            'status' => $response->status()
        ];
    }

    public function getContratoProd(Request $request)
    {
        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'c0nsult4Pr0d',
                "Filtro" => $request->contrato
            ]);

        $first = $response->collect()->first();
        $voz = $response->collect()->where('TIPO_PRODUCTO', '=',1)->first();
        $int = $response->collect()->where('TIPO_PRODUCTO', '=',24)->first();
        $tv = $response->collect()->whereIn('TIPO_PRODUCTO', [8900, 6042])->first();

        if ($first) {
            $contrato = collect([
                'NOMBRE' => $first['NAME'],
                'IDENTIFICACION' => $first['IDENTIFICATION'],
                'SUBSCRIPTION_ID' => $first['SUBSCRIPTION_ID'],
                'INC_VOZ' => $voz&&sizeof($voz) > 0?true:false,
                'INC_VOZ_ACT' => $voz&&sizeof($voz) > 0?true:false,
                'INC_INT' => $int&&sizeof($int) > 0?true:false,
                'INC_INT_ACT' => $int&&sizeof($int) > 0?true:false,
                'INC_TV' => $tv&&sizeof($tv) > 0?true:false,
                'INC_TV_ACT' => $tv&&sizeof($tv) > 0?true:false,
                'EMPAQUETADO' => ($voz&&valTrue($voz['EMPAQUETADO'])||$int&&valTrue($int['EMPAQUETADO'])||$tv&&valTrue($tv['EMPAQUETADO']))?true:false
            ]);
        } else {
            $contrato = null;
        }

        return [
            'voz' => $voz,
            'int' => $int,
            'tv' => $tv,
            'contrato' => $contrato,
            'status' => $response->status()
        ];
    }


}
