<?php

use Illuminate\Database\Seeder;

class Ventas_DetalleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Venta_Detalle::class, 20)->create();
    }
}
