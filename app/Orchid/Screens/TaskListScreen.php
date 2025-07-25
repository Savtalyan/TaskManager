<?php

namespace App\Orchid\Screens;

use App\Models\Task;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class TaskListScreen extends Screen
{
    public $name = 'Task List';

    public function query(): array
    {
        return [
            'tasks' => Task::with(['status', 'priority', 'assignee', 'assigner'])->paginate(15)
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('tasks', [
                TD::make('id', 'ID')->render(fn (Task $task) => $task->id),

                TD::make('subject')->sort()->filter(),

                TD::make('description'),

                TD::make('status', 'Status')->render(fn (Task $task) => $task->status->name ?? '-'),


                TD::make('priority')->render(function (Task $task) {
                    return $task->priority->name ?? '-';
                }),

                TD::make('due_date')->render(fn (Task $task) => $task->due_date?->format('Y-m-d')),

                TD::make('assignee', 'Assignee')->render(function (Task $task) {
                    return $task->assignee->name ?? '-';
                }),

                TD::make('assigner', 'Assigner')->render(function (Task $task) {
                    return $task->assigner->name ?? '-';
                }),
            ]),
        ];
    }
}
