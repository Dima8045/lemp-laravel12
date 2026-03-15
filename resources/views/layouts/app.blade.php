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