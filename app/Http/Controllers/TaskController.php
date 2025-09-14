<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Status;
use App\Models\Priority;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['status', 'priority', 'assignee', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $statuses = Status::all();
        $priorities = Priority::all();
        $users = User::all();

        return view('tasks.create', compact('statuses', 'priorities', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:statuses,id',
            'priority_id' => 'required|exists:priorities,id',
            'assignee_id' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date|after:now',
        ]);

        Task::create([
            'creator_id' => auth()->id(),
            'assigner_id' => auth()->id(),
            'assignee_id' => $request->assignee_id,
            'status_id' => $request->status_id,
            'priority_id' => $request->priority_id,
            'subject' => $request->subject,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Задача успешно создана!');
    }

    public function show(Task $task)
    {
        $task->load(['status', 'priority', 'assignee', 'assigner', 'creator']);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $statuses = Status::all();
        $priorities = Priority::all();
        $users = User::all();

        return view('tasks.edit', compact('task', 'statuses', 'priorities', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:statuses,id',
            'priority_id' => 'required|exists:priorities,id',
            'assignee_id' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $task->update([
            'assignee_id' => $request->assignee_id,
            'status_id' => $request->status_id,
            'priority_id' => $request->priority_id,
            'subject' => $request->subject,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Задача успешно обновлена!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена!');
    }

    public function take(Task $task)
    {
        $task->update([
            'assignee_id' => auth()->id(),
            'status_id' => Status::where('name', 'В работе')->first()->id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Вы взяли задачу в работу!');
    }
}
