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
    public function index()
    {
        $insumo = Insumo::get();
        return $insumo;
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
            'nombre' => 'string|required',
            'precio' => 'numeric|required',
        ]);

        $insumo = new Insumo();
        $insumo->nombre = $validatedRequest['nombre'];
        $insumo->precio = $validatedRequest['precio'];
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
        $validatedRequest = $request->validate([
            'nombre' => 'string|required',
            'precio' => 'numeric|required',
        ]);

        $insumo = Insumo::find($id);
        $insumo->nombre = $validatedRequest['nombre'];
        $insumo->precio = $validatedRequest['precio'];
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
        return $insumo;
    }
}
