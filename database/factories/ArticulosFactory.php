<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articulo;
use Faker\Generator as Faker;

$factory->define(Articulo::class, function (Faker $faker) {
    return [
        'nombre' => $faker->colorName,
        'precio'=>$precio=$faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 600),
        'costo'=>$faker->randomFloat($nbMaxDecimals = 2, $min = $precio / 2, $max = $precio),
    ];
});
