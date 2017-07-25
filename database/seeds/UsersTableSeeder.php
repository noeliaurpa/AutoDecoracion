<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'tell' => '88888888',
            'workstation' => 'Administrador',
            'remember_token' => str_random(10),
            'password' => bcrypt('admin'),
        ]);
    }
}
