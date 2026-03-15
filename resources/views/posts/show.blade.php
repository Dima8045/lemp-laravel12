@extends('layouts.app')

@section('content')
    <article>
        <header class="mb-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <a href="{{ route('blog.index') }}" class="text-zinc-500 hover:text-white transition text-sm flex items-center gap-2">
                    ← Назад до списку постів
                </a>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 text-white">
                {{ $post->title }}
            </h1>

            <div class="flex items-center gap-4 text-zinc-500 text-sm">
                <span>{{ $post->created_at->format('d M, Y') }}</span>
            </div>
        </header>

        <div class="prose prose-invert max-w-none text-zinc-300 leading-loose text-lg preserve-lines">
            {{ $post->body }}
        </div>

        <footer class="mt-16 pt-8 border-t border-zinc-800 flex justify-between items-center">
            <span class="text-zinc-600 text-xs uppercase tracking-widest">Кінець запису</span>
        </footer>
    </article>
@endsection