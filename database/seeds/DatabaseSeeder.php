<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TiposTableSeeder::class);
        $this->call(ArticulosTableSeeder::class);
        $this->call(InsumosTableSeeder::class);
        $this->call(Articulo_InsumoTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
    }
}
