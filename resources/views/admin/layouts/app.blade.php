<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #09090b; color: #e4e4e7; font-size: 1.1rem; }
        .form-input { background-color: #18181b; border: 1px solid #3f3f46; border-radius: 0.5rem; padding: 0.5rem 1rem; width: 100%; color: white; }
        .preserve-lines { white-space: pre-line; }


        /* Активна сторінка — робимо її контрастною (білою) */
        .pagination-dark [aria-current="page"] span {
            background-color: #ffffff !important; /* Білий фон */
            color: #000000 !important;           /* Чорний текст */
            border-color: #ffffff !important;
            font-weight: bold !important;
        }

        /* Ефект при наведенні на доступні сторінки */
        .pagination-dark a:hover {
            background-color: #27272a !important;
            color: #ffffff !important;
            border-color: #52525b !important;
        }

        /* Прибираємо синій контур (той самий баг) */
        .pagination-dark a:focus, 
        .pagination-dark span:focus {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
</head>
<body class="antialiased font-sans">
    <nav class="border-b border-zinc-800 p-6 mb-8">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <a href="{{ route('posts.index') }}" class="text-2xl font-bold tracking-tighter">БЛОГ</a>
            <a href="{{ route('posts.create') }}" class="bg-zinc-100 text-zinc-900 px-4 py-2 rounded-lg font-medium hover:bg-white transition">Створити пост</a>
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