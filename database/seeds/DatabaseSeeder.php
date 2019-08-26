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
        $this->call(ClientesTableSeeder::class);
        $this->call(InsumosTableSeeder::class);
    }
}
