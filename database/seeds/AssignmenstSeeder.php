<?php

use Illuminate\Database\Seeder;

class AssignmenstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = App\Client::pluck('id');
        foreach($clients as $client){
            factory(App\Assignment::class, 2)->create([
                'client_id' => $client
            ]);
        }

    }
}
