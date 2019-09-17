<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Remito_Detalle;
use App\Articulo;


class Remito_DetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($remitocabecera)
    {
        $remitodetalle = DB::table('remitos_detalle')
                                ->join('articulos', 'remitos_detalle.articulos_id','=','articulos.id')
                                ->where('remitos_detalle.remito_cabecera_id','=', $remitocabecera)
                                ->select('remitos_detalle.*','articulos.nombre')
                                ->get();
        return $remitodetalle;
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
        $remitodetalle = new Venta_Detalle();
        $remitodetalle->remito_cabecera_id = $request->remito_cabecera_id;
        $remitodetalle->articulo_id = $request->articulo_id;
        $remitodetalle->cantidad = $request->cantidad;
        $articulo = Articulo::find($request->articulo_id);
        $remitodetalle->precio = $articulo->precio;
        $remitodetalle->save();
        $remitodetalle->nombre = $articulo->nombre;
        return $remitodetalle;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
