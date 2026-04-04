<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService,
        private PostRepositoryInterface $post
        )
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => $this->post->getPaginated(4),
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
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->postService->create($request->validated());

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
    public function update(UpdateRequest $request, Post $post): RedirectResponse
    {
        $this->postService->update($post, $request->validated());

        return redirect()->route('admin.posts.index')->with('success', 'Пост успішно оновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->postService->delete($post);

        return redirect()->route('admin.posts.index')->with('success', 'Пост успішно видалено');
    }
}
