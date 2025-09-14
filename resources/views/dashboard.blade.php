@extends('layouts.app')

@section('title', 'Дашборд')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Добро пожаловать, {{ Auth::user()->name }}!</h1>
        <p class="mt-2 text-gray-600">Обзор ваших задач и статистика</p>
    </div>

    <!-- Статистика -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-tasks text-blue-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Всего задач</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['total_tasks'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-check text-green-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Мои задачи</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['my_tasks'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-plus-circle text-purple-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Создано мной</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['created_tasks'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-yellow-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Выполнено</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['completed_tasks'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Последние задачи -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Последние задачи</h3>
                <div class="space-y-3">
                    @forelse($recent_tasks as $task)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $task->subject }}</p>
                                <p class="text-xs text-gray-500">
                                    Статус: <span class="font-medium">{{ $task->status->name }}</span>
                                    @if($task->assignee)
                                        | Исполнитель: {{ $task->assignee->name }}
                                    @endif
                                </p>
                            </div>
                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-500">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Нет задач</p>
                    @endforelse
                </div>
                <div class="mt-4">
                    <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                        Посмотреть все задачи →
                    </a>
                </div>
            </div>
        </div>

        <!-- Мои задачи -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Мои задачи</h3>
                <div class="space-y-3">
                    @forelse($my_tasks as $task)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $task->subject }}</p>
                                <p class="text-xs text-gray-500">
                                    Статус: <span class="font-medium">{{ $task->status->name }}</span>
                                    | Приоритет: <span class="font-medium">{{ $task->priority->name }}</span>
                                </p>
                            </div>
                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-500">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">У вас нет назначенных задач</p>
                    @endforelse
                </div>
                <div class="mt-4">
                    <a href="{{ route('tasks.create') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                        Создать новую задачу →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
