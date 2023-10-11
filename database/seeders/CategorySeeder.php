<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'Монтажные работы'],
            ['title' => 'Строительство'],
            ['title' => 'Отделочные работы'],
            ['title' => 'Кровельные работы'],
            ['title' => 'Земляные работы'],
            ['title' => 'Демонтаж'],
            ['title' => 'Каменные работы'],
            ['title' => 'Слаботочные работы']
        ];

        DB::table('categories')->insert($categories);
    }
}
