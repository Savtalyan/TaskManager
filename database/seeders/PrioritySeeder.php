<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            ['name' => 'Низкий'],
            ['name' => 'Средний'],
            ['name' => 'Высокий'],
            ['name' => 'Критический'],
        ];

        foreach ($priorities as $priority) {
            Priority::create($priority);
        }
    }
}
