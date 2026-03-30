<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    )
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request) : View
    {
        $posts = $this->postRepository->getPublishedPaginated($request->query('search'), 4);

        return view('posts.index', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = $this->postRepository->getPublishedBySlug($slug);

        return view('posts.show', compact('post'));
    }
}
