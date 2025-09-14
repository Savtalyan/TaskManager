@extends('layouts.app')

@section('title', 'Список задач')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Задачи</h1>
        <a href="{{ route('tasks.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i>Создать задачу
        </a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
            @forelse($tasks as $task)
                <li class="px-6 py-4 hover:bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">
                                    <a href="{{ route('tasks.show', $task) }}" class="hover:text-blue-600">
                                        {{ $task->subject }}
                                    </a>
                                </p>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($task->status->name === 'Новая') bg-gray-100 text-gray-800
                                        @elseif($task->status->name === 'В работе') bg-blue-100 text-blue-800
                                        @elseif($task->status->name === 'На проверке') bg-yellow-100 text-yellow-800
                                        @elseif($task->status->name === 'Выполнена') bg-green-100 text-green-800
                                        @elseif($task->status->name === 'Отменена') bg-red-100 text-red-800
                                        @endif">
                                        {{ $task->status->name }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($task->priority->name === 'Низкий') bg-gray-100 text-gray-800
                                        @elseif($task->priority->name === 'Средний') bg-blue-100 text-blue-800
                                        @elseif($task->priority->name === 'Высокий') bg-orange-100 text-orange-800
                                        @elseif($task->priority->name === 'Критический') bg-red-100 text-red-800
                                        @endif">
                                        {{ $task->priority->name }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <div class="flex items-center space-x-4">
                                    <span>
                                        <i class="fas fa-user mr-1"></i>
                                        Создал: {{ $task->creator->name }}
                                    </span>
                                    @if($task->assignee)
                                        <span>
                                            <i class="fas fa-user-check mr-1"></i>
                                            Исполнитель: {{ $task->assignee->name }}
                                        </span>
                                    @endif
                                    @if($task->due_date)
                                        <span>
                                            <i class="fas fa-calendar mr-1"></i>
                                            Срок: {{ $task->due_date->format('d.m.Y') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if($task->description)
                                <p class="mt-2 text-sm text-gray-600">{{ Str::limit($task->description, 100) }}</p>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-500">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('tasks.edit', $task) }}" class="text-green-600 hover:text-green-500">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if(!$task->assignee_id)
                                <form method="POST" action="{{ route('tasks.take', $task) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-purple-600 hover:text-purple-500" 
                                            onclick="return confirm('Взять задачу в работу?')">
                                        <i class="fas fa-hand-paper"></i>
                                    </button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-500" 
                                        onclick="return confirm('Удалить задачу?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @empty
                <li class="px-6 py-4 text-center text-gray-500">
                    <i class="fas fa-tasks text-4xl mb-4"></i>
                    <p>Нет задач</p>
                    <a href="{{ route('tasks.create') }}" class="text-blue-600 hover:text-blue-500">
                        Создать первую задачу
                    </a>
                </li>
            @endforelse
        </ul>
    </div>

    <!-- Пагинация -->
    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
</div>
@endsection
