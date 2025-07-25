<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use App\Models\Status;
use App\Models\Priority;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'assigner' => User::factory(),
            'assignee' => User::factory(),

            // FIXED: wrap in closures so the ID is used
            'status'   => Status::insert([
                ['name' => 'To Do'],
                ['name' => 'In Progress'],
                ['name' => 'Done'],
            ]),

            'priority' => Priority::insert([
                ['name' => 'Low'],
                ['name' => 'Medium'],
                ['name' => 'High'],
            ]),
            'subject'     => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'due_date'    => now()->addDays(rand(1, 30)),
        ];
    }
}
