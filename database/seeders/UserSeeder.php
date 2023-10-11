<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Администратор',
                'email' => 'allu4kin@yandex.ru',
                'password' => bcrypt('123'),
                'role_id' => 1,
                'wallet_id' => 1,
                'telephone' => '89175537107'
            ],
        ];

        DB::table('users')->insert($users);
    }
}
