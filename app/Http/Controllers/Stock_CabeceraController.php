<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock_Cabecera;

class Stock_CabeceraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabecera = Stock_Cabecera::get();
        return $cabecera;
    }

    public function vista()
    {
        return view('stock-cabecera');
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
        $cabecera = new Stock_Cabecera();
        $cabecera->importe = $request->importe;
        //$cabecera->user_id = $request->user_id;
        $cabecera->user_id = auth()->user()['id'];
        //dd($user);0
        $cabecera->save();
        return $cabecera;
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
        $cabecera = Stock_Cabecera::find($id);
        $cabecera->importe = $request->importe;
        //$cabecera->user_id = $request->user_id;
        $cabecera->user_id = auth()->user()['id'];
        $cabecera->save();
        return $cabecera;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cabecera = Stock_Cabecera::find($id);
        $cabecera->delete();
    }
}
