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

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', function () {
    return view('index');
});

Route::middleware(['auth'])->group(function() {
    Route::get('articulos-insumos/{articulo_id}', ['as' => 'articulos-insumos.index', 'uses' => 'Articulo_InsumoController@index']);
    Route::resource('articulos-insumos', 'Articulo_InsumoController', ['except' => ['index']]);
    Route::resource('articulos', 'ArticuloController');
    Route::get('articulos-datos', 'ArticuloController@datos');
    Route::get('articulos-eliminados-datos', 'ArticuloController@eliminadosDatos');
    Route::put('articulos-restaurar/{articulo}', 'ArticuloController@restaurar');
    Route::resource('clientes', 'ClienteController');
    Route::get('clientes-datos', 'ClienteController@datos');
    Route::resource('insumos', 'InsumoController');
    Route::get('insumos-datos', 'InsumoController@datos');
    Route::resource('proveedores', 'ProveedorController');
    Route::resource('remitos-cabecera', 'Remito_CabeceraController');
    Route::resource('remitos-detalle', 'Remito_DetalleController');
    Route::resource('stock-cabecera', 'Stock_CabeceraController');
    Route::resource('stock-detalle', 'Stock_DetalleController');
    Route::resource('tipos', 'TipoController');
    Route::resource('users', 'UserController');
    Route::get('ventas-cabecera-datos', 'Venta_CabeceraController@datos');
    Route::resource('ventas-cabecera', 'Venta_CabeceraController');
    Route::get('ventas-detalle/{cabecera_id}', ['as' => 'ventas-detalle.index', 'uses' => 'Venta_DetalleController@index']);
    Route::resource('ventas-detalle', 'Venta_DetalleController', ['except' => ['index']]);
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
