<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => Post::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'slug' => 'nullable',
            'excerpt' => 'required|string|min:10|max:255',
            'body' => 'required|string|min:10',
            'is_published' => 'nullable',
            'published_at' => 'nullable',
            'user_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $slugBase = Str::slug($data['title']);
        $slug = $slugBase . '-' . rand(1, 999999);
        $data['slug'] = $slug;

        $data['is_published'] = $request->has('is_published') == 'on';
        $data['published_at'] = $request->has('is_published') ? now() : null;

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Пост успішно створено');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        return view('admin.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.edit', [
            'post' => $post,
        ]);
    }  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'slug' => 'nullable',
            'excerpt' => 'required|string|min:10|max:255',
            'body' => 'required|string|min:10',
            'is_published' => 'nullable',
            'published_at' => 'nullable',
            'user_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'delete_image' => ['sometimes', 'boolean'],
        ]);

        if ($request->input('delete_image') == '1') {
            if ($post->image) {
                FacadesStorage::disk('public')->delete($post->image);
            }
            $data['image'] = null;
        }
        
        if ($request->hasFile('image')) {
            if ($post->image) {
                FacadesStorage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }
        
        $data['is_published'] = $request->has('is_published') == 'on';
        $data['published_at'] = $request->has('is_published') ? now() : null;

        $post->update($data);
        
        return redirect()->route('admin.posts.index')->with('success', 'Пост успішно оновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Пост успішно видалено');
    }
}
