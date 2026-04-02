<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService
{
    public function create(array $data): Post
    {
        return DB::transaction(function () use ($data) {
            $image = $data['image'] ?? null;
            unset($data['image'], $data['delete_image']);
            
            $slugBase = Str::slug($data['title']);
            $slug = $slugBase . '-' . rand(1, 999999);
            $data['slug'] = $slug;

            $data['is_published'] = (bool) ($data['is_published'] ?? false);

            $post = Post::create($data);

            if ($image) {
                $post->image = $image->store('posts', 'public');
                $post->save();
            }

            return $post;
        });

    }

    public function update(Post $post, array $data): Post
    {
        return DB::transaction(function () use ($post, $data) {
            $image = $data['image'] ?? null;
            $deleteImage = (bool) ($data['delete_image'] ?? false);
            unset($data['image'], $data['delete_image']);

            $slugBase = Str::slug($data['title']);
            $slug = $slugBase . '-' . rand(1, 999999);
            $data['slug'] = $slug;

            $wasPublished = $post->is_published;
            $newPublished = (bool) ($data['is_published'] ?? $wasPublished);
            $data['is_published'] = $newPublished;

            if (!$wasPublished && $newPublished) {
                $data['published_at'] = now();
            }   elseif ($wasPublished && !$newPublished) {
                $data['published_at'] = null;
            }

            $post->update($data);

            if ($deleteImage && $post->image) {
                Storage::disk('public')->delete($post->image);
                $post->image = null;
            }

            if ($image) {
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }
                $post->image = $image->store('posts', 'public');
            }

            $post->save();

            return $post;
        });
    }

    public function delete(Post $post): void
    {
        DB::transaction(function () use ($post) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $post->delete();
        });
    }
}
