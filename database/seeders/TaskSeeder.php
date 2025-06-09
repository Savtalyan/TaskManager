<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'assigner' => 1,
            'assignee' => 2,
            'subject' => "test subject 1",
            'description' => "test description 1",
            'status' => "waiting",
            'priority' => "low",
            'due_date' => "2022-01-01",
        ]);

        Task::create([
            'assigner' => 1,
            'assignee' => 1,
            'subject' => "test subject the same",
            'description' => "test description the same",
            'status' => "waiting",
            'priority' => "low",
            'due_date' => "2022-01-02",
        ]);

        Task::create([
            'assigner' => 2,
            'assignee' => 1,
            'subject' => "test subject reverse",
            'description' => "test description reverse",
            'status' => "waiting",
            'priority' => "low",
            'due_date' => "2022-01-03",
        ]);

    }
}
