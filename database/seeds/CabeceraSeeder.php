<?php

use Illuminate\Database\Seeder;

class CabeceraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Stock_Cabecera::class,4)->create();
    }
}
