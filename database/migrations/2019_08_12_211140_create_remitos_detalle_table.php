<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemitosDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remitos_detalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('remito_cabecera_id')->unsigned();
            $table->bigInteger('articulo_id')->unsigned();
            $table->integer('cantidad');
            $table->float('precio', 10, 2);

            $table->foreign('remito_cabecera_id')->references('id')->on('remitos_cabecera');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remitos_detalle');
    }
}
