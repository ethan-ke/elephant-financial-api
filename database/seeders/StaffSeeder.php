<?php

namespace Database\Seeders;

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::insert([
            [
                'district_id' => 2,
                'name'        => '黎爽',
            ],
            [
                'district_id' => 2,
                'name'        => '廖倩华',
            ],
            [
                'district_id' => 2,
                'name'        => '戚嘉华',
            ],
            [
                'district_id' => 2,
                'name'        => '于芳',
            ],
        ]);
    }
}
