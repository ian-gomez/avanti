<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Remito_Cabecera;
use App\proveedores;

class Remito_CabeceraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $remito = DB::table('remitos_cabecera')
                    ->join('proveedores', 'remitos_cabecera.proveedor_id', '=', 'proveedores.id')
                    ->select('remitos_cabecera.*',
                                   'proveedores.nombre',
                                   DB::raw("(SELECT SUM(remitos_detalle.cantidad * remitos_detalle.precio) FROM remitos_detalle WHERE remitos_detalle.remito_cabecera_id = remitos_cabecera.id) AS importe"))
                    ->get();
                 
        return $remito;
       //$remito = Remito_Cabecera::get();
        //return $remito;
    }

    public function cabeceraView()
    {
        return view ('remito-cabecera');
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
            'proveedor_id' => 'numeric|exists:proveedores,id|required'
        ]);

        $remito = new Remito_Cabecera();
        $remito->user_id = auth()->user()['id'];
        $remito->proveedor_id = $request->proveedor_id;
        $remito->save();
        return $remito;
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
         $validatedRequest = $request->validate([
            'proveedor_id' => 'numeric|exists:proveedores,id|required'
        ]);
         
        $remito= Remito_Cabecera::find($id);
        $remito->user_id = auth()->user()['id'];
        $remito->proveedor_id = $request->proveedor_id;
        $remito->save();
        return $remito;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $remito = Remito_Cabecera::find($id);
        $remito->delete();
    }
}
