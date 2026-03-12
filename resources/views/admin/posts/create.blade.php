@extends('admin.layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-8">Новий пост</h1>

    <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-2 text-zinc-400">Заголовок</label>
            <input type="text" name="title" class="form-input" value="{{ old('title') }}" required>
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2 text-zinc-400">Короткий опис (Excerpt)</label>
            <textarea name="excerpt" rows="2" class="form-input">{{ old('excerpt') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2 text-zinc-400">Текст поста</label>
            <textarea name="body" rows="10" class="form-input">{{ old('body') }}</textarea>
            @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center gap-3 py-2">
            <input type="checkbox" 
                name="is_published" 
                id="is_published" 
                class="w-5 h-5 rounded border-zinc-700 bg-zinc-900 text-white focus:ring-0 focus:ring-offset-0"
                {{ old('is_published') ? 'checked' : '' }}>
            <label for="is_published" class="text-sm font-medium text-zinc-400 cursor-pointer select-none">
                Опублікувати відразу
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-white text-black px-6 py-2 rounded-lg font-bold hover:bg-zinc-200">Зберегти</button>
            <a href="{{ route('posts.index') }}" class="px-6 py-2 text-zinc-400 hover:text-white">Скасувати</a>
        </div>
    </form>
@endsection