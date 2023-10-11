<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['title' => 'Ожидание оплаты'],
            ['title' => 'Заявка отменена'],
            ['title' => 'Выполнение'],
            ['title' => 'Выполненено']
        ];

        DB::table('statuses')->insert($statuses);
    }
}