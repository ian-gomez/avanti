<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articulo_Insumo;
use Faker\Generator as Faker;

$factory->define(Articulo_Insumo::class, function (Faker $faker) {
    $articulos = App\Articulo::all();
    $articulos = $articulos->reject(function ($articulo) {
        return $articulo->tipo_id == 2;
    });
    return [
        'articulo_id' => $articulos->random()->id,
        'insumo_id' => $faker->unique()->randomElement(App\Insumo::pluck('id', 'id')->toArray()),
        'cantidad' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 300),
    ];
});
