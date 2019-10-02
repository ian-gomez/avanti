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
        $this->call(ProveedoresSeeder::class);
        $this->call(CabeceraSeeder::class);
        $this->call(DetalleSeeder::class);
        $this->call(TiposTableSeeder::class);
        $this->call(ArticulosTableSeeder::class);
        $this->call(InsumosTableSeeder::class);
        $this->call(Articulo_InsumoTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(Ventas_CabeceraTableSeeder::class);
        $this->call(Ventas_DetalleTableSeeder::class);
    }
}
