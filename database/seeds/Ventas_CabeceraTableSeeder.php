<?php

use Illuminate\Database\Seeder;

class Ventas_CabeceraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Venta_Cabecera::class, 10)->create();
    }
}
