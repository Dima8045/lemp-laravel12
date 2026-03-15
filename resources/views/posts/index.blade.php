@extends('layouts.app')

@section('title', 'Блог на Laravel 12')

@section('content')
    @forelse($posts as $post)
        <div class="hover:bg-zinc-900/30 transition">
            <div class="p-4">
                <h2 class="font-medium text-white">{{ $post->title }}</h2>
                <p class="text-sm text-zinc-500">{{ $post->excerpt }}<a href="{{ route('blog.show', $post->slug) }}" class="text-blue-400 hover:text-blue-500">читати далі</a></p>
                <p class="text-sm text-zinc-400">{{ $post->created_at->format('d.m.Y H:i') }}</p>
            </div>
        </div>
    @empty
        <p class="p-8 text-center text-zinc-500 italic">Постів не знайдено</p>
    @endforelse
    @if ($posts->hasPages())
            <div class="mt-8 pagination-dark">
        {{ $posts->links() }}
    </div>
    @endif
@endsection