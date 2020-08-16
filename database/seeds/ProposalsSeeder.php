<?php

use Illuminate\Database\Seeder;

class ProposalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assignments = \App\Assignment::pluck('id');
        $users = \App\User::pluck('id');
        foreach ($users as $user) {
            foreach ($assignments as $assignment){
                factory(App\Proposal::class)->create([
                    'assignment_id' => $assignment,
                    'user_id' => $user
                ]);
            }

        }
    }
}
