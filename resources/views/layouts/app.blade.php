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
<body class="antialiased font-sans">
    <nav class="border-b border-zinc-800 p-6 mb-8">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <a href="{{ route('blog.index') }}" class="text-2xl font-bold tracking-tighter">БЛОГ</a>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('admin.posts.create') }}" class="bg-zinc-100 text-zinc-900 px-4 py-2 rounded-lg font-medium hover:bg-white transition">Створити пост</a>
                    <span class="text-zinc-300">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-500 transition">Вийти</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-zinc-100 px-4 py-2 rounded-lg font-medium hover:text-white transition">Увійти</a>
                    <a href="{{ route('register') }}" class="bg-zinc-100 text-zinc-900 px-4 py-2 rounded-lg font-medium hover:bg-white transition">Реєстрація</a>
                @endauth
            </div>
        </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 pb-20">
        @if(session('success'))
            <div class="bg-green-900/30 border border-green-500 text-green-200 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>