<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "role" => "admin",
            "password" => bcrypt('admin'),
        ]);
        User::create([
           "name" => "Durand",
           "email" => "durand@chezlui.fr",
           "role" => "user",
           "password" => bcrypt('user'),
       ]);
    }
}
