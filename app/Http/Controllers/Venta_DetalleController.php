<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Venta_Detalle;
use App\Articulo;

class Venta_DetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($venta_cabecera_id)
    {
        $venta_detalle = DB::table('ventas_detalle')
                    ->join('articulos', 'ventas_detalle.articulo_id', '=', 'articulos.id')
                    ->where('ventas_detalle.venta_cabecera_id', '=', $venta_cabecera_id)
                    ->select('ventas_detalle.*', 'articulos.nombre')
                    ->get();
        return $venta_detalle;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venta_detalle = new Venta_Detalle();
        $venta_detalle->venta_cabecera_id = $request->venta_cabecera_id;
        $venta_detalle->articulo_id = $request->articulo_id;
        $venta_detalle->cantidad = $request->cantidad;
        $articulo = Articulo::find($request->articulo_id);
        $venta_detalle->precio = $articulo->precio;
        $venta_detalle->costo = $articulo->costo;
        $venta_detalle->save();
        $venta_detalle->nombre = $articulo->nombre;
        return $venta_detalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $venta_detalle = Venta_Detalle::find($id);
        $venta_detalle->venta_cabecera_id = $request->venta_cabecera_id;
        $venta_detalle->articulo_id = $request->articulo_id;
        $venta_detalle->cantidad = $request->cantidad;
        $venta_detalle->precio = $request->precio;
        $venta_detalle->costo = $request->costo;
        $venta_detalle->save();
        return $venta_detalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta_detalle = Venta_Detalle::find($id);
        $venta_detalle->delete();
        return $venta_detalle;
    }
}
