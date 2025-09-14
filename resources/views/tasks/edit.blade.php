@extends('layouts.app')

@section('title', 'Редактировать задачу')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Редактировать задачу</h1>
        <p class="mt-2 text-gray-600">Внесите изменения в задачу</p>
    </div>

    <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700">Название задачи *</label>
            <input type="text" name="subject" id="subject" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('subject') border-red-500 @enderror"
                   value="{{ old('subject', $task->subject) }}" placeholder="Введите название задачи">
            @error('subject')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('description') border-red-500 @enderror"
                      placeholder="Опишите задачу подробнее">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="status_id" class="block text-sm font-medium text-gray-700">Статус *</label>
                <select name="status_id" id="status_id" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('status_id') border-red-500 @enderror">
                    <option value="">Выберите статус</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ old('status_id', $task->status_id) == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
                @error('status_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="priority_id" class="block text-sm font-medium text-gray-700">Приоритет *</label>
                <select name="priority_id" id="priority_id" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('priority_id') border-red-500 @enderror">
                    <option value="">Выберите приоритет</option>
                    @foreach($priorities as $priority)
                        <option value="{{ $priority->id }}" {{ old('priority_id', $task->priority_id) == $priority->id ? 'selected' : '' }}>
                            {{ $priority->name }}
                        </option>
                    @endforeach
                </select>
                @error('priority_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="assignee_id" class="block text-sm font-medium text-gray-700">Исполнитель</label>
                <select name="assignee_id" id="assignee_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('assignee_id') border-red-500 @enderror">
                    <option value="">Не назначен</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assignee_id', $task->assignee_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('assignee_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700">Срок выполнения</label>
                <input type="datetime-local" name="due_date" id="due_date"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('due_date') border-red-500 @enderror"
                       value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d\TH:i') : '') }}">
                @error('due_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('tasks.index') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Отмена
            </a>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-save mr-2"></i>Сохранить изменения
            </button>
        </div>
    </form>
</div>
@endsection
