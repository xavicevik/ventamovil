<?php

namespace App\Http\Controllers;

use App\Models\Rifa;
use App\Models\Segmentos;
use App\Models\TiposCliente;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCliente(Request $request)
    {
        $url = config('edatel.serviceurl');
        $response = Http::retry(3, 100)->timeout(60)->withOptions(['verify' => false,])
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
            'segmento' => $segmento?$segmento->DESCRIPCION:'',
            'tipocliente' => $tipocliente?$tipocliente->DESCRIPCION:''
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
        $response = Http::retry(3, 100)->timeout(60)->withOptions(['verify' => false,])
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
        $response = Http::retry(3, 100)->timeout(60)->withOptions(['verify' => false,])
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
        $response = Http::retry(3, 100)->timeout(60)->withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'c0nsult4Pr0d',
                "Filtro" => $request->contrato
            ]);

        $first = $response->collect()->first();
        $voz = $response->collect()->where('TIPO_PRODUCTO', '=',1)->first();
        $int = $response->collect()->where('TIPO_PRODUCTO', '=',24)->first();
        $tv = $response->collect()->whereIn('TIPO_PRODUCTO', [8900, 6042])->first();

        $response2 = Http::retry(3, 100)->timeout(60)->withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'c0nsult4M0t1v0S0l',
                "Filtro" => $request->contrato
            ]);

        $solvoz = $response2->collect()->where('PRODUCT_TYPE_ID', '=',1)->first();
        $solint = $response2->collect()->where('PRODUCT_TYPE_ID', '=',24)->first();
        $soltv = $response2->collect()->whereIn('PRODUCT_TYPE_ID', [8900, 6042])->first();

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
                'INC_SOLVOZ' => $solvoz&&sizeof($solvoz) > 0?true:false,
                'INC_SOLINT' => $solint&&sizeof($solint) > 0?true:false,
                'INC_SOLTV' => $soltv&&sizeof($soltv) > 0?true:false,
                'EMPAQUETADO' => ($voz&&valTrue($voz['EMPAQUETADO'])||$int&&valTrue($int['EMPAQUETADO'])||$tv&&valTrue($tv['EMPAQUETADO']))?true:false
            ]);
        } else {
            $contrato = null;
        }

        return [
            'voz' => $voz,
            'int' => $int,
            'tv' => $tv,
            'solvoz' => $solvoz,
            'solint' => $solint,
            'soltv' => $soltv,
            'contrato' => $contrato,
            'status' => $response->status()
        ];
    }




}
