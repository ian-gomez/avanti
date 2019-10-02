<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Venta_Cabecera;
use App\Venta_Detalle;

class Venta_CabeceraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venta_cabecera = DB::table('ventas_cabecera')
                          ->join('clientes', 'ventas_cabecera.cliente_id', '=', 'clientes.id')
                          ->join('users', 'ventas_cabecera.user_id', '=', 'users.id')
                          ->select('ventas_cabecera.*',
                                   'clientes.nombre as cliente_nombre',
                                   'users.name as user_nombre',
                                   DB::raw("(SELECT SUM(ventas_detalle.cantidad * ventas_detalle.precio) FROM ventas_detalle WHERE ventas_detalle.venta_cabecera_id = ventas_cabecera.id) AS importe"))
                          ->get();
        return $venta_cabecera;
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
            'cliente_id' => 'numeric|required',
            'numero_ticket' => 'numeric|min:1|required',
        ]);

        $venta_cabecera = new Venta_Cabecera();
        $venta_cabecera->cliente_id = $validatedRequest['cliente_id'];
        $venta_cabecera->user_id = Auth::id();
        $venta_cabecera->numero_ticket = $validatedRequest['numero_ticket'];
        $venta_cabecera->save();

        $cabecera = Venta_Cabecera::where('numero_ticket', $request->numero_ticket)->first();
        $user = $cabecera->user;
        $venta_cabecera->user_nombre = $user->name;
        $cliente = $cabecera->cliente;
        $venta_cabecera->cliente_nombre = $cliente->nombre;
        return $venta_cabecera;
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
            'cliente_id' => 'numeric|required',
            'numero_ticket' => 'numeric|min:1|required',
        ]);

        $venta_cabecera = Venta_Cabecera::find($id);
        $venta_cabecera->cliente_id = $validatedRequest['cliente_id'];
        $venta_cabecera->numero_ticket = $validatedRequest['numero_ticket'];
        $venta_cabecera->save();

        $cabecera = Venta_Cabecera::find($id);
        $user = $cabecera->user;
        $venta_cabecera->user_nombre = $user->name;
        $cliente = $cabecera->cliente;
        $venta_cabecera->cliente_nombre = $cliente->nombre;
        return $venta_cabecera;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta_detalle = Venta_Detalle::where('venta_cabecera_id', $id);
        $venta_cabecera = Venta_Cabecera::find($id);
        DB::transaction(function() use ($venta_detalle, $venta_cabecera) {
            $venta_detalle->delete();
            $venta_cabecera->delete();
        });
        return $venta_cabecera;
    }
}
