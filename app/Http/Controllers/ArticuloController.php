<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Articulo;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function datos()
    {
        $articulo = DB::table('articulos')
                    ->join('tipos', 'articulos.tipo_id', '=', 'tipos.id')
                    ->select('articulos.*', 'tipos.nombre as tipo_nombre')
                    ->get();
        return $articulo;
    }

    public function index()
    {
        return view('articulos');
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
        $articulo = new Articulo();
        $articulo->nombre = $request->nombre;
        $articulo->tipo_id = $request->tipo_id;
        $articulo->precio = $request->precio;
        $articulo->costo = $request->costo;
        $articulo->save();

        $tipo_nombre = Articulo::all();
        $tipo_nombre = $tipo_nombre->where('nombre', $request->nombre);
        $tipo_nombre = $tipo_nombre->first();
        $articulo->tipo_nombre = $tipo_nombre->tipo->nombre;
        return $articulo;
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
        $articulo = Articulo::find($id);
        $articulo->nombre = $request->nombre;
        $articulo->tipo_id = $request->tipo_id;
        $articulo->precio = $request->precio;
        $articulo->costo = $request->costo;
        $articulo->save();
        return $articulo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->delete();
        return back();
    }
}
