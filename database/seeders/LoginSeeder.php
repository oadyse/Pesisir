<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Eka',
                    'username' => 'admin',
                    'role' => 'admin',
                    'password' => bcrypt('123456'),
                ],
                [
                    'name' => 'Oady',
                    'username' => 'staff',
                    'role' => 'staff',
                    'password' => bcrypt('123456'),
                ],
            ]
        );
    }
}
