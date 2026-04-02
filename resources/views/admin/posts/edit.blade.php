@extends('admin.layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-8">Редагувати пост</h1>

    <form action="{{ route('admin.posts.update', $post) }}" class="space-y-6" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div>
            <label class="block text-sm font-medium mb-2 text-zinc-400">Зображення</label>
            <input type="file" name="image" class="form-input" accept="image/*">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        @if (@isset($post) && $post->image_url) 
            <div>
                <img id="image-preview" src="{{ $post->image_url }}" alt="Попередній перегляд зображення" class="mb-2 w-full max-h-64 object-cover rounded">
            </div>

            <div class="flex items-center gap-3 py-2">
                <input type="checkbox" 
                    name="delete_image" 
                    value="1"
                    id="delete_image" 
                    class="w-5 h-5 rounded border-zinc-700 bg-zinc-900 text-white focus:ring-0 focus:ring-offset-0">
                <label for="delete_image" class="text-sm font-medium text-zinc-400 cursor-pointer select-none">
                    Видалити поточне зображення
                </label>
            </div>
        @endif
        <div>
            <label class="block text-sm font-medium mb-2 text-zinc-400">Заголовок</label>
            <input type="text" name="title" class="form-input" value="{{ $post->title }}" required>
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2 text-zinc-400">Короткий опис</label>
            <textarea name="excerpt" rows="2" class="form-input">{{ $post->excerpt }}</textarea>
            @error('excerpt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2 text-zinc-400">Текст поста</label>
            <textarea name="body" rows="10" class="form-input">{{ $post->body }}</textarea>
            @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center gap-3 py-2">
            <input type="checkbox" 
                name="is_published" 
                id="is_published" 
                class="w-5 h-5 rounded border-zinc-700 bg-zinc-900 text-white focus:ring-0 focus:ring-offset-0"
                {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
            <label for="is_published" class="text-sm font-medium text-zinc-400 cursor-pointer select-none">
                Статус публікації
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-white text-black px-6 py-2 rounded-lg font-bold hover:bg-zinc-200">Зберегти</button>
            <a href="{{ route('admin.posts.index') }}" class="px-6 py-2 text-zinc-400 hover:text-white">Скасувати</a>
        </div>
    </form>
    <footer class="mt-16 pt-8 border-t border-zinc-800 flex justify-between items-center">
    <span class="text-zinc-600 text-xs uppercase tracking-widest">Кінець запису</span>
    
    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Ви впевнені?')">
        @csrf @method('DELETE')
        <button class="text-xs text-red-900 hover:text-red-500 uppercase tracking-widest transition">
            Видалити цей пост
        </button>
    </form>
</footer>
@endsection