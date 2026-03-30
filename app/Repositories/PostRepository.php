<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{
    public function getPublishedPaginated(?string $search, int $perPage): LengthAwarePaginator
    {
        $query = Post::query()->where('is_published', true);

        if ($search = trim((string) $search)) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        return $query
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function getPublishedBySlug(string $slug): ?\App\Models\Post
    {
        return Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
    }
}
