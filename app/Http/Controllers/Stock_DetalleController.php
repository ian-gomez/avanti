<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Stock_Detalle;
use App\articulos;
use App\Stock_Cabecera;   

class Stock_DetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($stockcabecera)
    {
        $Stock_Detalle = DB::table('Stock_Detalle')
                    ->join('articulos','Stock_Detalle.articulo_id','=','articulos.id')
                    ->where('Stock_Detalle.stock_cabecera_id','=', $stockcabecera)
                    ->select('Stock_Detalle.*','articulos.nombre')
                    ->get();
        return $Stock_Detalle; 
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
        $Stock_Detalle = new Stock_Detalle(); 
        $Stock_Detalle->cantidad = $request->cantidad;
        $Stock_Detalle->precio = $request->precio;
        $Stock_Detalle->costo = $request->costo;
        $Stock_Detalle->save();
        return $Stock_Detalle;
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
        $Stock_Detalle = Stock_Detalle::find($id);
        $Stock_Detalle->delete();
    }
}
