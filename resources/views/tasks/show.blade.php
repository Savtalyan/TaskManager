@extends('layouts.app')

@section('title', $task->subject)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $task->subject }}</h1>
                <div class="mt-2 flex items-center space-x-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($task->status->name === 'Новая') bg-gray-100 text-gray-800
                        @elseif($task->status->name === 'В работе') bg-blue-100 text-blue-800
                        @elseif($task->status->name === 'На проверке') bg-yellow-100 text-yellow-800
                        @elseif($task->status->name === 'Выполнена') bg-green-100 text-green-800
                        @elseif($task->status->name === 'Отменена') bg-red-100 text-red-800
                        @endif">
                        {{ $task->status->name }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($task->priority->name === 'Низкий') bg-gray-100 text-gray-800
                        @elseif($task->priority->name === 'Средний') bg-blue-100 text-blue-800
                        @elseif($task->priority->name === 'Высокий') bg-orange-100 text-orange-800
                        @elseif($task->priority->name === 'Критический') bg-red-100 text-red-800
                        @endif">
                        {{ $task->priority->name }}
                    </span>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('tasks.edit', $task) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-edit mr-2"></i>Редактировать
                </a>
                @if(!$task->assignee_id)
                    <form method="POST" action="{{ route('tasks.take', $task) }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded"
                                onclick="return confirm('Взять задачу в работу?')">
                            <i class="fas fa-hand-paper mr-2"></i>Взять в работу
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Основная информация -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Описание</h3>
                @if($task->description)
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $task->description }}</p>
                    </div>
                @else
                    <p class="text-gray-500 italic">Описание не указано</p>
                @endif
            </div>
        </div>

        <!-- Детали задачи -->
        <div class="space-y-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Детали задачи</h3>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Создатель</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $task->creator->name }}</dd>
                    </div>
                    
                    @if($task->assignee)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Исполнитель</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $task->assignee->name }}</dd>
                        </div>
                    @endif
                    
                    @if($task->assigner)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Назначил</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $task->assigner->name }}</dd>
                        </div>
                    @endif
                    
                    @if($task->due_date)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Срок выполнения</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $task->due_date->format('d.m.Y H:i') }}
                                @if($task->due_date->isPast() && $task->status->name !== 'Выполнена')
                                    <span class="text-red-600 font-medium">(просрочено)</span>
                                @endif
                            </dd>
                        </div>
                    @endif
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Создано</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $task->created_at->format('d.m.Y H:i') }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Обновлено</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $task->updated_at->format('d.m.Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Действия -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Действия</h3>
                <div class="space-y-3">
                    <a href="{{ route('tasks.edit', $task) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-edit mr-2"></i>Редактировать
                    </a>
                    
                    @if(!$task->assignee_id)
                        <form method="POST" action="{{ route('tasks.take', $task) }}">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700"
                                    onclick="return confirm('Взять задачу в работу?')">
                                <i class="fas fa-hand-paper mr-2"></i>Взять в работу
                            </button>
                        </form>
                    @endif
                    
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700"
                                onclick="return confirm('Удалить задачу?')">
                            <i class="fas fa-trash mr-2"></i>Удалить
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('tasks.index') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left mr-2"></i>Назад к списку
        </a>
    </div>
</div>
@endsection
