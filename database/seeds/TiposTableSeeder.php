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
            'titulo' => 'Articulo'
        ]));
        factory(App\Tipo::Create([
            'titulo' => 'Insumo'
        ]));
        factory(App\Tipo::Create([
            'titulo' => 'Bebida'
        ]));
    }
}
