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
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['guest']],function(){

    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::post('/', [LoginController::class, 'authenticate'])->name('login.authenticate');

    Route::get('/master/getDepartamentos', [MasterController::class, 'getDepartamentos'])->name('master.getDepartamentos');
    Route::get('/master/getLocalidadDepartamento', [MasterController::class, 'getLocalidadDepartamento'])->name('master.getLocalidadDepartamento');


});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {
    // Tigo UNE
    Route::get('/main', [PrincipalController::class, 'index'])->name('main.index');
    Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
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


    //Route::get('/master/getDepartamentos', [MasterController::class, 'getDepartamentos'])->name('master.getDepartamentos');
    //Route::get('/master/getLocalidadDepartamento', [MasterController::class, 'getLocalidadDepartamento'])->name('master.getLocalidadDepartamento');

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
    Route::get('/paquete/store', [VentaController::class, 'storepaquete'])->name('paquete.store');




    //TIgo UNE


    Route::post('/changepasssu', [LoginController::class, 'updatePasswordsu'])->name('changepass.updatesu');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // export
    Route::get('/users/export', [UserController::class, 'UsersExport'])->name('users.export');
    Route::get('/clientes/export', [UserController::class, 'ClientesExport'])->name('clientes.export');

    Route::get('/boletas/export', function (Request $request) {
        return Excel::download(new BoletasExport($request), 'boletas.xlsx');
    })->name('boletas.export');

    Route::get('/reservas/export', function (Request $request) {
        return Excel::download(new VentasExport($request), 'reservas.xlsx');
    })->name('reservas.export');

    Route::post('/numerosreservados/import', function (Request $request) {
        Excel::import(new NumeroreservadoImport($request), $request->file('file'));

        return redirect()->back()->with('message', 'Archivo importado correctamente');
    })->name('numerosreservados.import');

    Route::get('/loterias', [MasterController::class, 'loterias'])->name('loterias');
    Route::get('/terminos', [MasterController::class, 'terminos'])->name('terminos');
    Route::get('/users/getClientes', [UserController::class, 'getClientes'])->name('users.clientes');
    Route::get('/ventas/sumary', [VentaController::class, 'sumary'])->name('sumary');
    Route::resource('series', SerieController::class);

    Route::get('/users/getVendedoresActivos', [UserController::class, 'getVendedoresActivos'])->name('users.getVendedoresActivos');
    Route::get('/users/getClientesActivos', [UserController::class, 'getClientesActivos'])->name('users.getClientesActivos');
    Route::get('/users/indexclientes', [UserController::class, 'indexclientes'])->name('users.indexclientes');
    Route::get('/users/indexvendedores', [UserController::class, 'indexvendedores'])->name('users.indexvendedores');
    Route::get('/users/getConfVendedor', [UserController::class, 'getConfVendedor'])->name('users.getConfVendedor');
    Route::put('/users/vendedor/{vendedor}', [UserController::class, 'updateVendedor'])->name('users.updateVendedor');
    Route::put('/users/cliente/{cliente}', [UserController::class, 'updateCliente'])->name('users.updateCliente');
    Route::get('/users/cliente/{cliente}', [UserController::class, 'showClient'])->name('users.showClient');

    Route::resource('users', UserController::class);

   // Route::resource('/puntoventas', PuntoventaController::class);

    Route::post('/rifas/copy', [RifaController::class, 'copy'])->name('rifas.copy');
    Route::get('/rifas/getRifasActivas', [RifaController::class, 'getRifasActivas'])->name('rifas.getRifasActivas');
    Route::get('/rifas/indexboletas', [RifaController::class, 'indexboletas'])->name('rifas.indexboletas');
    Route::get('/rifas/getHistorialBoleta', [RifaController::class, 'getHistorialBoleta'])->name('rifas.getHistorialBoleta');

    Route::get('/cajas/movimientos', [CajaController::class, 'movimientos'])->name('cajas.movimientos');
    Route::get('/cajas/open', [CajaController::class, 'open'])->name('cajas.open');
    Route::post('/cajas/apertura', [CajaController::class, 'apertura'])->name('cajas.apertura');
   // Route::post('/cajas/cierre', [CajaController::class, 'cierre'])->name('cajas.cierre');
    Route::get('/cajas/cierre', [CajaController::class, 'cierre'])->name('cajas.cierre');
    Route::get('/cajas/printcierre', [CajaController::class, 'printcierre'])->name('cajas.printcierre');
    Route::get('/cajas', [CajaController::class, 'index'])->name('cajas.index');
    Route::get('/cajas/historial', [CajaController::class, 'historial'])->name('cajas.historial');
    Route::get('/cajas/getHistorial', [CajaController::class, 'getHistorial'])->name('cajas.getHistorial');

    Route::resource('transacciones',TransaccionController::class);
    Route::resource('pagos',Pagocontroller::class);


    Route::resource('rifas', RifaController::class);
    Route::resource('confcomisiones',ConfcomisionController::class);
    Route::resource('comisiones',ComisionController::class);
    Route::resource('transacciones',TransaccionController::class);
    Route::post('webhooks', [WebhooksController::class, 'webhooks'])->name('webhooks');

    Route::resource('roles', RoleController::class);

    Route::get('/numerosreservados', [NumeroreservadoController::class, 'index'])->name('numerosreservados.index');
    Route::get('/numerosreservados/valBoletaDisponible', [NumeroreservadoController::class, 'valBoletaDisponible'])->name('numerosreservados.valBoletaDisponible');
    Route::get('/numerosreservados/valBoletaOcupada', [NumeroreservadoController::class, 'valBoletaOcupada'])->name('numerosreservados.valBoletaOcupada');
    Route::get('/numerosreservados/eliminarReserva', [NumeroreservadoController::class, 'eliminarReserva'])->name('numerosreservados.eliminarReserva');
    Route::get('/numerosreservados/reportpdfAsignacion', [NumeroreservadoController::class, 'reportpdfAsignacion'])->name('numerosreservados.reportpdfAsignacion');
    Route::get('/numerosreservados/reportpdfDesasignacion', [NumeroreservadoController::class, 'reportpdfDesasignacion'])->name('numerosreservados.reportpdfDesasignacion');
    Route::get('/numerosreservados/reportpdfCliente', [NumeroreservadoController::class, 'reportpdfCliente'])->name('numerosreservados.reportpdfCliente');



    Route::get('/numerosreservados/getBoletaVendida', [NumeroreservadoController::class, 'getBoletaVendida'])->name('numerosreservados.getBoletaVendida');
    Route::resource('numerosreservados', NumeroreservadoController::class);

    Route::get('/ventas/getDetalles', [VentaController::class, 'getDetalles'])->name('ventas.getDetalles');
    Route::get('/ventas/getDetallesHistorial', [VentaController::class, 'getDetallesHistorial'])->name('ventas.getDetallesHistorial');
    Route::get('/ventas/valBoletaLibre', [VentaController::class, 'valBoletaLibre'])->name('ventas.valBoletaLibre');

    Route::get('/ventas/reportpdf', [VentaController::class, 'reportpdf'])->name('reportpdf');


    Route::resource('ventas', VentaController::class);

    Route::get('/cart/validarId', [CartController::class, 'validarId'])->name('validarId');
    Route::resource('/cart', CartController::class);

    Route::get('/master/getDashboard', [MasterController::class, 'getDashboard'])->name('master.getDashboard');
    Route::get('/master/getEmpresas', [MasterController::class, 'getEmpresas'])->name('master.getEmpresas');
    Route::get('/master/getRoles', [MasterController::class, 'getRoles'])->name('master.getRoles');
    Route::get('/master/index', [MasterController::class, 'rolesIndex'])->name('master.index');
    Route::get('/master/rolesshow', [MasterController::class, 'rolesshow'])->name('master.rolesshow');
    Route::get('/master/rolesedit', [MasterController::class, 'rolesedit'])->name('master.rolesedit');
    Route::get('/master/rolesupdate', [MasterController::class, 'rolesupdate'])->name('master.rolesupdate');
    Route::get('/master/paises', [MasterController::class, 'paisesIndex'])->name('master.paises');
    Route::get('/master/empresas', [MasterController::class, 'empresasIndex'])->name('master.empresas');
    Route::get('/master/series', [MasterController::class, 'seriesIndex'])->name('master.series');
    Route::get('/master/terminos', [MasterController::class, 'terminosIndex'])->name('master.terminos');

    Route::get('/master/puntoventas', [PuntoventaController::class, 'index'])->name('master.puntosventa');
    Route::get('/master/tiposdoc', [MasterController::class, 'tipodocIndex'])->name('master.tiposdoc');
    Route::get('/master/tiposdocsearch', [MasterController::class, 'tipodocSearch'])->name('master.tiposdocsearch');
    Route::get('/enviar', [EmailController::class, 'send'])->name('enviar');
    Route::get('/detalleventa', [EmailController::class, 'send'])->name('detalleventa');

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/vendedor', [ReporteController::class, 'vendedor'])->name('reportes.vendedor');
    Route::get('/reportes/getDetalleVendedor', [ReporteController::class, 'getDetalleVendedor'])->name('reportes.getDetalleVendedor');

    Route::get('/reportes/ventavendedor', [ReporteController::class, 'ventavendedor'])->name('reportes.ventavendedor');
    Route::get('/reportes/ventagetDetalleVendedor', [ReporteController::class, 'ventagetDetalleVendedor'])->name('reportes.ventagetDetalleVendedor');
    Route::get('/reportes/resumenvendedores', [ReporteController::class, 'resumenvendedores'])->name('reportes.resumenvendedores');


    //});
});




