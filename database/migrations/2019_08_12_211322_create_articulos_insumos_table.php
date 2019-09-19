<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos_insumos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('articulo_id')->unsigned();
            $table->bigInteger('insumo_id')->unsigned();
            $table->decimal('cantidad', 10, 2);

            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->foreign('insumo_id')->references('id')->on('insumos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos_insumos');
    }
}
