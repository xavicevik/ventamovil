<?php

namespace App\Http\Controllers;

use App\Exports\BoletasExport;
use App\Exports\VentasExport;
use App\Imports\NumeroreservadoImport;
use \Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use \App\Models\Loteria;
use \App\Models\Rol;
use \App\Models\Terminosycondiciones;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

Route::group(['middleware'=>['guest']],function(){

    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::post('/', [LoginController::class, 'authenticate'])->name('login.authenticate');

    Route::get('/master/getDepartamentos', [MasterController::class, 'getDepartamentos'])->name('master.getDepartamentos');
    Route::get('/master/getLocalidadDepartamento', [MasterController::class, 'getLocalidadDepartamento'])->name('master.getLocalidadDepartamento');

});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/main', [PrincipalController::class, 'index'])->name('main.index');
    Route::get('/cliente.crear', [ClienteController::class, 'create'])->name('cliente.create');
    Route::post('/cliente/store', [ClienteController::class, 'store'])->name('cliente.store');
    Route::get('/cliente/store', [ClienteController::class, 'store'])->name('cliente.store');
    Route::get('/master/getTiposdocumento', [MasterController::class, 'getTiposdocumento'])->name('master.getTiposdocumento');
    Route::get('/master/getTipoCliente', [MasterController::class, 'getTipoCliente'])->name('master.getTipoCliente');
    Route::get('/master/getSegmentos', [MasterController::class, 'getSegmentos'])->name('master.getSegmentos');
    Route::get('/master/getRestricciones', [MasterController::class, 'getRestricciones'])->name('master.getRestricciones');
    Route::get('/venta/getVelocidades', [VentaController::class, 'getVelocidades'])->name('venta.getVelocidades');

    Route::get('/cliente/getCliente', [ClienteController::class, 'getCliente'])->name('master.getCliente');
    Route::get('/master/getBarrioLocalidad', [MasterController::class, 'getBarrioLocalidad'])->name('master.getBarrioLocalidad');
    Route::post('/direccion/storeDirInsta', [VentaController::class, 'storeDirInsta'])->name('direccion.storeDirInsta');
    Route::get('/direccion/storeDirInsta', [VentaController::class, 'storeDirInsta'])->name('direccion.storeDirInsta');

    // Registro de venta
    Route::get('/venta', [VentaController::class, 'index'])->name('venta.index');
    Route::get('/venta.crear', [VentaController::class, 'create'])->name('venta.create');
    Route::post('/venta/store', [VentaController::class, 'store'])->name('venta.store');
    Route::get('/venta/store', [VentaController::class, 'store'])->name('venta.store');
    Route::get('/venta/getCliente', [VentaController::class, 'getCliente'])->name('venta.getCliente');
    Route::get('/venta/getComercialPlan', [VentaController::class, 'getComercialPlan'])->name('venta.getComercialPlan');
    Route::get('/venta/getComercialPlanInd', [VentaController::class, 'getComercialPlanInd'])->name('venta.getComercialPlanInd');
    Route::get('/venta/getSalesPlan', [VentaController::class, 'getSalesPlan'])->name('venta.getSalesPlan');

    // Cambio de velocidad
    Route::get('/velocidad.cambio', [VentaController::class, 'changeSpeed'])->name('velocidad.changeSpeed');
    Route::get('/velocidad/store', [VentaController::class, 'storeSpeed'])->name('velocidad.storeSpeed');
    Route::post('/velocidad/store', [VentaController::class, 'storeSpeed'])->name('velocidad.storeSpeed');
    Route::get('/velocidad/getContrato', [VentaController::class, 'getContrato'])->name('velocidad.getContrato');
    Route::get('/velocidad/getProductVoz', [VentaController::class, 'getProductVoz'])->name('velocidad.getProductVoz');
    Route::get('/cliente/getContrato', [ClienteController::class, 'getContrato'])->name('master.getContrato');
    Route::get('/venta/getVelocidadesCambio', [VentaController::class, 'getVelocidadesCambio'])->name('venta.getVelocidadesCambio');

    // Paquete
    Route::get('/venta.paquete', [VentaController::class, 'empaquetar'])->name('venta.paquete');
    Route::get('/cliente/getContratoProd', [ClienteController::class, 'getContratoProd'])->name('master.getContratoProd');
    Route::get('/venta/getComercialPlanPaq', [VentaController::class, 'getComercialPlanPaq'])->name('venta.getComercialPlanPaq');
    Route::get('/venta/storepaquete', [VentaController::class, 'storepaquete'])->name('venta.storepaquete');

    // Solicitudes
    Route::get('/solicitudes', [VentaController::class, 'solicitudes'])->name('solicitudes');
    Route::get('/solicitudes/consultar', [VentaController::class, 'getsolicitudes'])->name('getsolicitudes');
    Route::get('/solicitudes/detalles', [VentaController::class, 'getDetallesolicitudes'])->name('getDetallesolicitudes');

});




