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
        $this->call(ArticuloSeeder::class);
        $this->call(CabeceraSeeder::class);
        $this->call(DetalleSeeder::class);
    }
}
