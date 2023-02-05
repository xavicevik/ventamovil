<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Localidad;
use App\Models\Puntoventa;
use App\Models\User;
use App\Models\Vendedor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Features;
use Symfony\Component\Console\Input\Input;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;


class LoginController extends Controller
{
    use PasswordValidationRules;

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token = csrf_token();
        $arrayDepartamentos = Departamento::all();

        return Inertia::render('Auth/Login', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            '_token' => $token,
            'arrayDepartamentos' => $arrayDepartamentos,
        ]);
    }


    public function authenticate(Request $request)
    {
        $token = csrf_token();

        $url = config('edatel.serviceurl');
        $response = Http::withOptions(['verify' => false,])
            ->asForm()
            ->post($url, [
                "ListaVal" => 'v4l1d4Usu4r10',
                "Vendedor" => $request->Vendedor,
                "Identificacion" => $request->Identificacion,
                "IMEI" => $request->telefono
            ]);

        if ($response->body() != '0/') {
            return back()->withErrors([
                'username' => 'Error '.$response->body(),
            ])->onlyInput('username');
        } else {

        }
        $user = User::where('id', 1)->first();
        Auth::login($user, true);

        $localidad = Localidad::where('CODIGO', $request->localidad)->first();

        $request->session()->regenerate();
        $request->session()->push('Vendedor', $request->Vendedor);
        $request->session()->push('Identificacion', $request->Identificacion);
        $request->session()->push('IMEI', $IMEI);
        $request->session()->push('departamento', $request->departamento);
        $request->session()->push('localidad', $request->localidad);
        $request->session()->push('localidaddesc', $localidad->DESCRIPCION);
        return redirect()->intended('main');
    }


}
