@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Керування постами</h1>
</div>

<div class="overflow-x-auto rounded-xl border border-zinc-800">
    <table class="w-full text-left border-collapse">
        <thead class="bg-zinc-900/50 text-zinc-400 text-sm uppercase tracking-wider">
            <tr>
                <th class="p-4 border-b border-zinc-800">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'title', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="hover:text-white flex items-center gap-1">
                        Заголовок ⇅
                    </a>
                </th>
                <th class="p-4 border-b border-zinc-800">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'is_published', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="hover:text-white flex items-center gap-1">
                        Статус ⇅
                    </a>
                </th>
                <th class="p-4 border-b border-zinc-800">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="hover:text-white flex items-center gap-1">
                        Дата ⇅
                    </a>
                </th>
                <th class="p-4 border-b border-zinc-800 text-right">Дії</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-800">
            @forelse($posts as $post)
                <tr class="hover:bg-zinc-900/30 transition">
                    <td class="p-4">
                        <div class="font-medium text-white">{{ $post->title }}</div>
                        <div class="text-xs text-zinc-500">{{ Str::limit($post->slug, 30) }}</div>
                    </td>
                    <td class="p-4">
                        @if($post->is_published)
                            <span class="text-[10px] px-2 py-0.5 rounded border border-green-500/30 bg-green-900/20 text-green-500 font-bold uppercase">Published</span>
                        @else
                            <span class="text-[10px] px-2 py-0.5 rounded border border-zinc-700 bg-zinc-800 text-zinc-500 font-bold uppercase">Draft</span>
                        @endif
                    </td>
                    <td class="p-4 text-sm text-zinc-400">
                        {{ $post->created_at->format('d.m.Y H:i') }}
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.posts.show', $post->slug ?? $post->id) }}" class="text-zinc-400 hover:text-white">👁</a>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-zinc-400 hover:text-blue-400">✎</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Видалити?')">
                                @csrf @method('DELETE')
                                <button class="text-zinc-500 hover:text-red-500">✕</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-zinc-500 italic">Постів не знайдено</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-8 pagination-dark">
    {{ $posts->links() }}
</div>
@endsection