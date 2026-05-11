<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class ApiPostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::query()->latest()->paginate(10);

        return response()->json([
            'data' => $posts->items(),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post || !$post->is_published) {
            return response()->json([
                'message' => 'Пост не найден или не опубликован.'
            ], 404);
        }

        return response()->json([
            'data' => $post
        ]);
    }
}
