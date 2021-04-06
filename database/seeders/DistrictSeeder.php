<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::insert([
            [
                'name' => '长沙'
            ],
            [
                'name' => '重庆'
            ],
            [
                'name' => '南京'
            ],
        ]);
    }
}
