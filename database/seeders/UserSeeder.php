<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => '黎爽',
            ],
            [
                'name' => '廖倩华',
            ],
            [
                'name' => '戚嘉华',
            ],
            [
                'name' => '于芳',
            ],
        ]);
    }
}
