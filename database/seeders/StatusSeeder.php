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
            [
                'title' => 'Обработка заказа',
                'icon' => 'fa-spinner fa-pulse'
            ],
            [
                'title' => 'Заказ отменён',
                'icon' => 'fa-times'
            ],
            [
                'title' => 'Выполнение заказа',
                'icon' => 'fa-spinner fa-pulse'
            ],
            [
                'title' => 'Заказ выполнен',
                'icon' => 'fa-check'
                ]
        ];

        DB::table('statuses')->insert($statuses);
    }
}
