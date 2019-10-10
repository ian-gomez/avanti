<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datos()
    {
        $proveedor = Proveedor::get();
        return $proveedor;
    }

    public function index()
    {  
        return view('proveedor');        
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
            'nombre' => 'string|min:1|max:255|required',
            'telefono' => 'string|min:1|max:255|required',
            'direccion' => 'string|min:1|max:255|required',
            ]);
        
        
        
        $proveedor = new Proveedor();
        $proveedor->nombre = $validatedRequest['nombre'];
        $proveedor->telefono = $validatedRequest['telefono'];
        $proveedor->direccion = $validatedRequest['direccion'];
        $proveedor->save();
        return $proveedor;
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
        $proveedor= Proveedor::find($id);
        $proveedor->nombre =$request->nombre;
        $proveedor->telefono =$request->telefono;
        $proveedor->direccion =$request->direccion;
        $proveedor->save();
        return $proveedor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->delete();
    }
}
