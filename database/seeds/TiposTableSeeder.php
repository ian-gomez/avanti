<?php

use Illuminate\Database\Seeder;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tipo::Create([
            'nombre' => 'Articulo'
        ]));
        factory(App\Tipo::Create([
            'nombre' => 'Insumo'
        ]));
        factory(App\Tipo::Create([
            'nombre' => 'Bebida'
        ]));
    }
}
