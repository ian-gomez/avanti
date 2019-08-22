<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::create([
        'name' => "root",
        'email' => "root@mail.com",
        'password' => bcrypt('123'),
        'rol'=> '1',
        'remember_token' => str_random(10),
    	]));
        factory(App\User::class, 10)->create();
    }
}
