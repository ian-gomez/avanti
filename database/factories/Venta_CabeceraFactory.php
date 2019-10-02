<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Venta_Cabecera;
use Faker\Generator as Faker;

$factory->define(Venta_Cabecera::class, function (Faker $faker) {
    return [
        'cliente_id' => App\Cliente::all()->random()->id,
        'user_id' => App\User::all()->random()->id,
        'numero_ticket' => $faker->unique()->numberBetween($min = 1000, $max = 9000),
    ];
});
