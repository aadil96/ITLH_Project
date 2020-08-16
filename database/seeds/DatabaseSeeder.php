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
       $this->call([
           BatchSeeder::class,
           UsersSeeder::class,
           ClientsSeeder::class,
           AssignmenstSeeder::class,
           ProposalsSeeder::class
       ]);
    }
}
