<?php

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

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//administrador de recursos para los roles
Route::ApiResource('roles', 'Role\RoleController');
Route::get('roles-all', 'Role\RoleController@all');
Route::ApiResource('users.roles', 'User\UserRoleController')->only(['index']);
Route::put('usersRoles/{user}', 'User\UserController@updateRole');
//administrador de recursos para los permisos
Route::ApiResource('permissions', 'Permission\PermissionController')->only('index');
//administrador de recursos para los usuarios
Route::ApiResource('users', 'User\UserController');
Route::get('users-all', 'User\UserController@all');
Route::get('user-id', 'User\UserController@getId');

Route::ApiResource('companies', 'CompanyController');

Route::ApiResource('vehicles', 'VehicleController');
Route::get('vehicles-user', 'VehicleController@indexByUser');

Route::ApiResource('vehiclebrands', 'VehicleBrandController');
Route::post('newvehiclebrand', 'VehicleBrandController@store');
Route::ApiResource('vehiculotipos', 'VehiculoTipoController');
Route::get('vehiclebrands-all', 'VehicleBrandController@all');
Route::get('vehiculotipos-all', 'VehiculoTipoController@all');
Route::get('select-tipos', 'VehiculoTipoController@selectTipos');
Route::get('select-marcas', 'VehicleBrandController@selectMarcas');

Route::ApiResource('vehiclemodels', 'VehicleModelController');
Route::get('vehiclemodels-all', 'VehicleModelController@all');

Route::ApiResource('vbrands', 'VehicleBrandModelController');
Route::get('vbrands-all', 'VehicleBrandModelController@brands');
Route::ApiResource('vmodels', 'VehicleBrandModelController');
Route::get('vmodels-all/{brand}', 'VehicleBrandModelController@models');
Route::get('brands-models', 'VehicleBrandModelController@all');
Route::post('newbrandmodel', 'VehicleBrandModelController@store');
Route::post('newvehiculotipo', 'VehiculoTipoController@store');
Route::post('newVehiclemodelo', 'VehicleModelController@store');
Route::ApiResource('vyears', 'VehicleYearController');
Route::get('vyears-all/{brand}/{model}', 'VehicleYearController@all');
Route::ApiResource('vengines', 'VehicleEngineController');
Route::get('vengines-all/{brand}/{model}/{year}', 'VehicleEngineController@all');
Route::ApiResource('quotationuser', 'QuotationUserController');
Route::post('quotation-mechanic', 'QuotationUserController@storeMechanic');
Route::ApiResource('pendingquotations', 'QuotationUserDescriptionController');

Route::ApiResource('detailvehicles', 'DetailVehicleController');

Route::ApiResource('notes', 'NoteController');

Route::ApiResource('quotations', 'QuotationController');
Route::get('quotation-details/{id}', 'QuotationController@details');

Route::ApiResource('quotationclients', 'QuotationclientController');
Route::get('quotationclient-details/{id}', 'QuotationclientController@details');

Route::ApiResource('quotationimports', 'QuotationimportController');
Route::get('quotationimport-pdf/{id}', 'QuotationimportController@pdf');

Route::get('quotation-pdf/{id}', 'QuotationController@pdf');
Route::get('quotationclient-pdf/{id}', 'QuotationclientController@pdf');
Route::get('quotationclient-pdf-iva/{id}', 'QuotationclientController@pdfIva');

Route::ApiResource('imports', 'ImportController');
Route::get('import-details/{id}', 'ImportController@details');
Route::ApiResource('detailimports', 'DetailimportController');
Route::ApiResource('archiveimports', 'ArchiveimportController');

Route::ApiResource('details', 'DetailController');
Route::ApiResource('detailclients', 'DetailclientController');

Route::ApiResource('clients', 'ClientController');
Route::get('clients-all', 'ClientController@all');

Route::ApiResource('activities', 'ActivityController');

Route::ApiResource('products', 'ProductController');
Route::get('products-all', 'ProductController@all');

Route::ApiResource('productimports', 'ProductimportController');
Route::get('productimports-all', 'ProductimportController@all');

Route::ApiResource('codes', 'CodeController');
Route::get('code-inventories/{id}', 'CodeController@inventories');

Route::ApiResource('inventories', 'InventoryController');
Route::get('all-inventories', 'InventoryController@all');

Route::ApiResource('images', 'ImageController');

///sección de excel
Route::get('export-users', 'User\UserController@export');
Route::get('export-import/{id}', 'ImportController@export');

Route::ApiResource('bill', 'BillController');
Route::post('bill', 'BillController@upload');
Route::get('test', 'BillController@test');
Route::get('all', 'BillController@all');

Route::get('product-codes/{product}', 'ProductController@codes');
Route::get('productss', 'ProductController@products');
Route::post('sale', 'SaleController@sale');
Route::get('all-sales', 'SaleController@index');
Route::get('sale-products/{sale}', 'SaleController@products');
Route::get('code-search/{code}', 'CodeController@search');
Route::get('product-search/{code}', 'CodeController@product');
Route::get('mechanic-clients', 'User\UserController@clients');
Route::post('mechanic-client', 'User\UserController@storeclient');
Route::get('client-vehicles', 'VehicleController@clientvehicles');


//seccion cotizacion
Route::get('/cotizar', 'QuotationUserController@cotizar');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::post('/upload', 'ImageController@upload');


Auth::routes();

//////////////////////////////////
///////////////////////////////////
Route::middleware(['auth'])->group(function () {

    Route::get('admin-roles', function () {
        return view('role.roles');
    })->name('admin-roles'); //->middleware('permission:roles');

    Route::get('admin-clientes', function () {
        return view('admin.clientes');
    })->name('admin-clientes'); //->middleware('permission:clientes');

    Route::get('admin-productos', function () {
        return view('admin.productos');
    })->name('admin-productos');

    Route::get('admin-codigos', function () {
        return view('admin.codigos');
    })->name('admin-codigos');

    Route::get('admin-inventario', function () {
        return view('admin.inventario');
    })->name('admin-inventario');

    Route::get('admin-usuarios', function () {
        return view('role.users');
    })->name('admin-usuarios'); //->middleware('permission:usuarios');

    Route::get('perfil', function () {
        return view('admin.detalle-usuario');
    })->name('perfil'); //->middleware('permission:usuarios');

    Route::get('admin-usuariosM', function () {
        return view('admin.users');
    })->name('admin-usuariosM'); //->middleware('permission:usuarios-m');

    Route::get('admin-vehiculos', function () {
        return view('admin.vehiculo');
    })->name('admin-vehiculos'); //->middleware('permission:vehiculos');

    Route::get('admin-vehiculosM', function () {
        return view('admin.vehiculo-mecanico');
    })->name('admin-vehiculosM'); //->middleware('permission:vehiculos-m');

    Route::get('admin-ventas', function () {
        return view('admin.ventas');
    })->name('admin-ventas');

    Route::get('admin-marca-vehiculos', function () {
        return view('admin.marcas-vehiculo');
    })->name('admin-marca-vehiculos'); //->middleware('permission:marca-vehiculos');

    Route::get('admin-modelo-vehiculos', function () {
        return view('admin.modelos-vehiculo');
    })->name('admin-modelo-vehiculos'); //->middleware('permission:marca-vehiculos');

    Route::get('admin-notas', function () {
        return view('admin.notas');
    })->name('admin-notas'); //->middleware('permission:notas');

    Route::get('admin-cotizaciones', function () {
        return view('admin.cotizaciones');
    })->name('admin-cotizaciones'); //->middleware('permission:cotizaciones');

    Route::get('admin-cotizacionesformales', function () {
        return view('admin.cotizaciones-formales');
    })->name('admin-cotizacionesformales'); //->middleware('permission:cotizaciones');

    Route::get('admin-importaciones', function () {
        return view('admin.importaciones');
    })->name('admin-importaciones'); //->middleware('permission:importaciones');

    Route::get('/', 'HomeController@index')->name('home');


    /**
     * Administrador de Boletas y Facturas
     */
    Route::get('admin-boleta', function () {
        return view('admin.boleta');
    })->name('admin-boleta'); //->middleware('permission:usuarios-m');

    Route::post('/Invoice/Generator', 'BillController@getDataInvoice')->name('Invoice-Generator');
});
