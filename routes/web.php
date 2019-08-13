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

Route::middleware(['auth'])->group(function() {
    Route::resource('articulos-insumos', 'Articulo_InsumoController');
    Route::resource('articulos', 'ArticuloController');
    Route::resource('clientes', 'ClienteController');
    Route::resource('proveedores', 'ProveedorController');
    Route::resource('remitos-cabecera', 'Remito_CabeceraController');
    Route::resource('remitos-detalle', 'Remito_DetalleController');
    Route::resource('stock-cabecera', 'Stock_CabeceraController');
    Route::resource('stock-detalle', 'Stock_DetalleController');
    Route::resource('users', 'UserController');
    Route::resource('ventas-cabecera', 'Venta_CabeceraController');
    Route::resource('ventas-detalle', 'Venta_DetalleController');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
