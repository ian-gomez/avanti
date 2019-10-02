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

Route::middleware(['auth'])->group(function() {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('articulos-insumos/{articulo_id}', ['as' => 'articulos-insumos.index', 'uses' => 'Articulo_InsumoController@index']);
    Route::resource('articulos-insumos', 'Articulo_InsumoController', ['except' => ['index']]);
    Route::resource('articulos', 'ArticuloController');
    Route::get('articulos-eliminados', 'ArticuloController@eliminadosDatos');
    Route::put('articulos-restaurar/{articulo}', 'ArticuloController@restaurar');
    Route::resource('clientes', 'ClienteController');
    Route::resource('insumos', 'InsumoController');
    Route::resource('proveedores', 'ProveedorController');
    Route::resource('remitos-cabecera', 'Remito_CabeceraController');
    Route::resource('remitos-detalle', 'Remito_DetalleController');
    Route::resource('stock-cabecera', 'Stock_CabeceraController');
    Route::get('stock-cabecera-vista', 'Stock_CabeceraController@vista');
    Route::resource('users', 'UserController');
    Route::resource('ventas-cabecera', 'Venta_CabeceraController');
    Route::get('stock-detalle/{stockcabecera}', ['as' => 'stock-detalle.index', 'uses' => 'Stock_DetalleController@index']);
    Route::resource('stock-detalle', 'Stock_DetalleController', ['except' => ['index']]);
    Route::resource('tipos', 'TipoController');
    Route::get('ventas-detalle/{venta_cabecera_id}', ['as' => 'ventas-detalle.index', 'uses' => 'Venta_DetalleController@index']);
    Route::resource('ventas-detalle', 'Venta_DetalleController', ['except' => ['index']]);
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


