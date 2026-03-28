<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request) : View
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->when($request->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            })
            ->orderBy('published_at', 'desc')
            ->paginate(4)
            ->withQueryString();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        abort_unless($post->is_published, 404);

        return view('posts.show', compact('post'));
    }
}
