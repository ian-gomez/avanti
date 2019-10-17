<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Stock_Detalle;
use App\Articulo;
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
        $stock_detalle = DB::table('stock_detalle')
                    ->join('articulos','articulos.id','=','stock_detalle.articulo_id')
                    ->where('stock_detalle.stock_cabecera_id','=', $stockcabecera)
                    ->select('stock_detalle.*','articulos.nombre')
                    ->get();
        return $stock_detalle; 
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
        $validatedRequest = $request->validate([
            'cantidad' => 'numeric|min:1|',
        ]);

        $stock_detalle = new stock_detalle(); 
        $stock_detalle->stock_cabecera_id = $request->stock_cabecera_id;
        $stock_detalle->cantidad = $request->cantidad;
        $articulo = Articulo::find($request->articulos_id);
        $stock_detalle->articulo_id = $request->articulos_id;
        $stock_detalle->precio = $articulo->precio;
        $stock_detalle->fecha = date('Y-m-d H:i:s');
        $stock_detalle->save();
        
        return $stock_detalle;
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
        $stock_detalle = Stock_Detalle::find($id);
        $stock_detalle->delete();
        return $stock_detalle;
    }
}
