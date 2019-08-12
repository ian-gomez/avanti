<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_detalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('venta_cabecera_id')->unsigned();
            $table->bigInteger('articulo_id')->unsigned();
            $table->integer('cantidad');
            $table->float('precio');
            $table->float('costo');

            $table->foreign('venta_cabecera_id')->references('id')->on('ventas_cabecera');
            $table->foreign('articulo_id')->references('id')->on('articulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_detalle');
    }
}
