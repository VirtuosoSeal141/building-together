<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['measure' => 'шт'],
            ['measure' => 'м2'],
            ['measure' => 'смена'],
        ];

        DB::table('units')->insert($units);
    }
}
