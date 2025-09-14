<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        
        $stats = [
            'total_tasks' => Task::count(),
            'my_tasks' => Task::where('assignee_id', $user->id)->count(),
            'created_tasks' => Task::where('creator_id', $user->id)->count(),
            'completed_tasks' => Task::where('assignee_id', $user->id)
                ->whereHas('status', function($query) {
                    $query->where('name', 'Выполнена');
                })->count(),
        ];

        $recent_tasks = Task::with(['status', 'priority', 'assignee'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $my_tasks = Task::where('assignee_id', $user->id)
            ->with(['status', 'priority', 'creator'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'recent_tasks', 'my_tasks'));
    }
}
