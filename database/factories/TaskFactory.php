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
            'creator_id' => User::factory(),
            'assigner_id' => User::factory(),
            'assignee_id' => User::factory(),
            'status_id' => Status::inRandomOrder()->first()->id ?? 1,
            'priority_id' => Priority::inRandomOrder()->first()->id ?? 1,
            'subject' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'due_date' => now()->addDays(rand(1, 30)),
        ];
    }
}
