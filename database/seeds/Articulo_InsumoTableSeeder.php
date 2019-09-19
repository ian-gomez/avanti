<?php

use Illuminate\Database\Seeder;

class Articulo_InsumoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Articulo_Insumo::class, 10)->create();
    }
}
