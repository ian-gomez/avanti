<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Venta_Detalle;
use Faker\Generator as Faker;

$factory->define(Venta_Detalle::class, function (Faker $faker) {
    $articulo = App\Articulo::all()->random();
    return [
        'venta_cabecera_id' => App\Venta_Cabecera::all()->random()->id,
        'articulo_id' => $articulo->id,
        'cantidad' => $faker->randomDigitNotNull,
        'precio' => $articulo->precio,
        'costo' => $articulo->costo,
    ];
});
