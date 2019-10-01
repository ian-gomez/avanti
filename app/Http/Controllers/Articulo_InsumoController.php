<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Articulo_Insumo;
use App\Articulo;

class Articulo_InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($articulo_id)
    {
        $articulo_insumo = DB::table('articulos_insumos')
                    ->join('insumos', 'articulos_insumos.insumo_id', '=', 'insumos.id')
                    ->where('articulos_insumos.articulo_id', '=', $articulo_id)
                    ->select('articulos_insumos.*', 'insumos.nombre')
                    ->get();
        return $articulo_insumo;
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
            'articulo_id' => 'numeric|required',
            'insumo_id' => 'numeric|required',
            'cantidad' => 'numeric|required',
        ]);

        $articulo_insumo = new Articulo_Insumo();
        $articulo_insumo->articulo_id = $validatedRequest['articulo_id'];
        $articulo_insumo->insumo_id = $validatedRequest['insumo_id'];
        $articulo_insumo->cantidad = $validatedRequest['cantidad'];
        $articulo_insumo->save();
        // TODO buscar si hay mejor forma de obtener el nombre del insumo
        $insumo_nombre = Articulo::find($request->articulo_id);
        $insumo_nombre = $insumo_nombre->insumos;
        $insumo_nombre = $insumo_nombre->where('id', $request->insumo_id);
        $insumo_nombre = $insumo_nombre->first();
        $articulo_insumo->nombre = $insumo_nombre->nombre;
        return $articulo_insumo;
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
            'articulo_id' => 'numeric|required',
            'insumo_id' => 'numeric|required',
            'cantidad' => 'numeric|required',
        ]);

        $articulo_insumo = Articulo_Insumo::find($id);
        $articulo_insumo->articulo_id = $validatedRequest['articulo_id'];
        $articulo_insumo->insumo_id = $validatedRequest['insumo_id'];
        $articulo_insumo->cantidad = $validatedRequest['cantidad'];
        $articulo_insumo->save();
        return $articulo_insumo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo_insumo = Articulo_Insumo::find($id);
        $articulo_insumo->delete();
        return $articulo_insumo;
    }
}
