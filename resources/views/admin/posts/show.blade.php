@extends('admin.layouts.app')

@section('content')
    <article>
        <header class="mb-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <a href="{{ route('admin.posts.index') }}" class="text-zinc-500 hover:text-white transition text-sm flex items-center gap-2">
                    ← Назад до таблиці
                </a>

                <div class="flex items-center gap-3">
                    @if($post->is_published)
                        <span class="text-[10px] px-2 py-1 rounded border border-green-500/30 bg-green-900/20 text-green-500 uppercase tracking-widest font-bold">
                            Опубліковано
                        </span>
                    @else
                        <span class="text-[10px] px-2 py-1 rounded border border-amber-500/30 bg-amber-900/20 text-amber-500 uppercase tracking-widest font-bold">
                            Чернетка
                        </span>
                    @endif

                    <a href="{{ route('admin.posts.edit', $post) }}" class="text-[10px] px-2 py-1 rounded border border-zinc-700 bg-zinc-800 text-zinc-300 hover:text-white uppercase tracking-widest font-bold transition">
                        Редагувати
                    </a>
                </div>
            </div>
            @if (@isset($post) && $post->image_url) 
                <div>
                    <img id="image-preview" src="{{ $post->image_url }}" alt="Попередній перегляд зображення" class="mb-2 w-full max-h-64 object-cover rounded">
                </div>
            @endif
            
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 text-white">
                {{ $post->title }}
            </h1>

            <div class="flex items-center gap-4 text-zinc-500 text-sm">
                <span>{{ $post->created_at->format('d M, Y') }}</span>
                <span class="text-zinc-800">|</span>
                <span>ID: {{ $post->id }}</span>
            </div>
        </header>

        {{-- Контент поста --}}
        <div class="prose prose-invert max-w-none text-zinc-300 leading-relaxed text-lg preserve-lines border-l border-zinc-800 pl-6 italic mb-10">
            {{ $post->excerpt }}
        </div>

        <div class="prose prose-invert max-w-none text-zinc-300 leading-loose text-lg preserve-lines">
            {{ $post->body }}
        </div>
    </article>
@endsection