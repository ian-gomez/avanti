<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stock_Detalle;
use Faker\Generator as Faker;

$factory->define(Stock_Detalle::class, function (Faker $faker) {
    return [
       'precio'=>$precio=$faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 600),
       'cantidad'=>$faker->randomFloat($nbMaxDecimals = 2, $min = $precio / 2, $max = $precio),
       'stock_cabecera_id'=>App\Stock_Cabecera::all()->random()->id,
       'articulo_id'=>App\Articulo::all()->random()->id,
       'fecha'=>$fecha=$faker->dateTimeBetween($startDate = '-5 days', $endDate = 'now', $timezone = null),
    ];
});
