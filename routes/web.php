<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('blog.index'))->name('index');

Route::prefix('admin')->as('admin.')->middleware('auth')->group(function () {
    Route::resource('posts', AdminPostController::class)->scoped([
        'post' => 'slug',
    ]);
});

Route::prefix('blog')->as('blog.')->group(function () {
    Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('show');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});