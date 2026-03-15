<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController as AdminPosetController;

Route::get('/', fn() => redirect()->route('blog.index'))->name('index');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::resource('posts', AdminPosetController::class)->scoped([
        'post' => 'slug',
    ]);
});

Route::prefix('blog')->as('blog.')->group(function () {
    Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('show');
});