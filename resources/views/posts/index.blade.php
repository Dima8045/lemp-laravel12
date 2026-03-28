@extends('layouts.app')

@section('title', 'Блог на Laravel 12')

@section('content')
    <form method="GET" action="{{ route('blog.index') }}" class="mb-8">
        <div class="flex gap-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Пошук за назвою або текстом поста..."
                class="w-full rounded-xl bg-zinc-900/60 border border-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button
                type="submit"
                class="px-6 py-3 rounded-xl bg-white text-black font-semibold hover:bg-zinc-200 transition"
            >
                Пошук
            </button>
        </div>
    </form>
    @if($posts->count())
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($posts as $post)
                <article class="bg-zinc-900/40 border border-zinc-800 rounded-2xl overflow-hidden hover:bg-zinc-900/70 hover:border-zinc-700 transition duration-300 shadow-sm">
                    @if($post->image)
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <img
                                src="{{ asset('storage/' . $post->image) }}"
                                alt="{{ $post->title }}"
                                class="w-full h-56 object-cover"
                            >
                        </a>
                    @endif

                    <div class="p-6 flex flex-col h-full">
                        <h2 class="text-xl font-semibold text-white mb-3">
                            {{ $post->title }}
                        </h2>

                        <p class="text-zinc-400 mb-4 leading-relaxed">
                            {{ $post->excerpt }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-zinc-800 mt-auto">
                            <span class="text-sm text-zinc-500">
                                {{ $post->created_at->format('d.m.Y H:i') }}
                            </span>

                            <a
                                href="{{ route('blog.show', $post->slug) }}"
                                class="text-blue-400 hover:text-blue-300 font-medium transition"
                            >
                                читати далі →
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <p class="p-8 text-center text-zinc-500 italic">
            Постів не знайдено
        </p>
    @endif

    @if ($posts->hasPages())
        <div class="mt-10 pagination-dark">
            {{ $posts->links() }}
        </div>
    @endif
@endsection