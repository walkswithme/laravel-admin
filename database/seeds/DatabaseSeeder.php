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
         $this->call(UsersSeeder::class);
         $this->call(GroupsSeeder::class);
         $this->call(ExtensionManagerSeeder::class);
         $this->call(ACLSeeder::class);
    }
}
