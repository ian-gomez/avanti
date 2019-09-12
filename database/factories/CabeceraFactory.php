<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stock_Cabecera;
use Faker\Generator as Faker;

$factory->define(Stock_Cabecera::class, function (Faker $faker) {
    return [
        'numero_remito' => $faker->creditCardNumber,
        'fecha' => $faker->dateTimeBetween($startDate = '-5 days', $endDate = 'now', $timezone = null),
        'user_id'=>App\User::all()->random()->id,
        'proveedor_id'=>App\Proveedor::all()->random()->id, 
    ];
});
