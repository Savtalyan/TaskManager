<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Manager')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @auth
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-white text-xl font-bold">
                        <i class="fas fa-tasks mr-2"></i>Task Manager
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                        <i class="fas fa-home mr-1"></i>Дашборд
                    </a>
                    <a href="{{ route('tasks.index') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                        <i class="fas fa-list mr-1"></i>Задачи
                    </a>
                    <a href="{{ route('tasks.create') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                        <i class="fas fa-plus mr-1"></i>Создать
                    </a>
                    
                    <div class="relative">
                        <button class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                            <i class="fas fa-user mr-1"></i>{{ Auth::user()->name }}
                        </button>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-blue-200 px-3 py-2 rounded-md">
                            <i class="fas fa-sign-out-alt mr-1"></i>Выйти
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <main class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>
