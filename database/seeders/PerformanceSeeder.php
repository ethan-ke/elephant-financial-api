<?php

namespace Database\Seeders;

use App\Models\Performance;
use Illuminate\Database\Seeder;

class PerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Performance::insert([
            [
                'user_id'         => 1,
                'price'           => 5480,
                'number'          => 17,
                'commission_rate' => 0.01,
                'status'          => 1,
            ],
            [
                'user_id'         => 1,
                'price'           => 5480,
                'number'          => 10,
                'commission_rate' => 0.03,
                'status'          => 1,
            ],
        ]);
    }
}
