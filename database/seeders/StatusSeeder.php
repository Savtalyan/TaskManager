<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Новая'],
            ['name' => 'В работе'],
            ['name' => 'На проверке'],
            ['name' => 'Выполнена'],
            ['name' => 'Отменена'],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
