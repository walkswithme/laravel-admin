<?php

use ExtensionsValley\Dashboard\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public function run()
    {

        $result = User::create([
            'name' => 'Admin',
            'email' => 'admin@wwm.com',
            'password' => bcrypt('123456'),
            'groups' => '1',
            'status' => '1',
        ]);


    }
}
