<?php

use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = [
            'January', 'February', 'March', 'April',
            'May', 'June', 'July', 'August',
            'September', 'October', 'November', 'December'
        ];

        foreach ($months as $month){
            DB::table('batches')->insert([
                'name' => $month,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
