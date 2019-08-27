<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insumo;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datos()
    {
        $insumo = Insumo::get();
        return $insumo;
    }

    public function index()
    {
        return view('insumos');
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
        $insumo = new Insumo();
        $insumo->nombre = $request->nombre;
        $insumo->precio = $request->precio;
        $insumo->cantidad = $request->cantidad;
        $insumo->save();
        return $insumo;
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
        $insumo = Insumo::find($id);
        $insumo->nombre = $request->nombre;
        $insumo->precio = $request->precio;
        $insumo->cantidad = $request->cantidad;
        $insumo->save();
        return $insumo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insumo = Insumo::find($id);
        $insumo->delete();
        return back();
    }
}
