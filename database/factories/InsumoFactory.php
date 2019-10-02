<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Insumo;
use Faker\Generator as Faker;

$factory->define(Insumo::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->word,
        'precio'=>$precio=$faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 500),
        'cantidad'=>$cantidad=$faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 999),
    ];
});
