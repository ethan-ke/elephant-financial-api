<?php

namespace Database\Seeders;

use App\Models\BackendUser;
use Illuminate\Database\Seeder;

class BackendUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BackendUser::insert([
            [
                'nickname' => 'Elephant',
                'username' => 'xiangwen',
                'password' => '$2y$10$tbFFr.4cXnHHQ679cLB5Z.y4rUphDarnl3r4hxmMJ6Nag0Cgn/Fou',
            ]
        ]);
    }
}
