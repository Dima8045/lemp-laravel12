<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel 12 Блог')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    <style>
   
    </style>
</head>
<body class="antialiased font-sans flex">
    <!-- Лівий Sidebar -->
    <aside class="w-64 bg-zinc-900 text-white min-h-screen p-6">
        <h2 class="text-xl font-bold mb-6">Адмін панель</h2>
        <nav>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('admin.posts.index') }}" class="block py-2 px-4 rounded-lg hover:bg-zinc-700 transition">Пости</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded-lg hover:bg-zinc-700 transition">Користувачі</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Основний вміст -->
    <div class="flex-1 flex flex-col">
        <nav class="max-w-6xl px-6 pb-5 border-b border-zinc-800 bg-[#020617] p-4">
            <div class="flex justify-between items-center w-full px-4">
                
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-400 via-purple-400 to-pink-400 flex items-center justify-center shadow-lg">
                        <span class="text-zinc-900 font-black text-lg">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <span class="text-white font-bold text-lg tracking-tight">{{ ucfirst(auth()->user()->role->value) }}</span>
                </div>
{{-- <h1>{{ dd(mb_convert_case(mb_substr(auth()->user()->name, 0, 1), MB_CASE_UPPER, 'UTF-8')) }}</h1> --}}
{{-- <h1>{{ dd(substr(auth()->user()->name, 0, 1)) }}</h1> --}}
                <div class="flex items-center gap-6">
                    @auth
                        <div class="flex items-center gap-2">
                            <span class="text-zinc-400 text-sm">Привіт,</span>
                            <span class="text-zinc-200 font-medium text-sm">{{ auth()->user()->name }}</span>
                        </div>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-400 text-sm font-semibold transition-colors">
                                Выйти
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-zinc-400 hover:text-white text-sm font-medium transition">Увійти</a>
                    @endauth
                </div>

            </div>
        </nav>

        <main class="flex-1 max-w-6xl px-6 pt-6 pb-20">
            @if(session('success'))
                <div class="bg-green-900/30 border border-green-500 text-green-200 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>