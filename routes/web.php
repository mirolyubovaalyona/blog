<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostsController::class, 'index']);
Route::get('post/', [PostsController::class, 'index'])->name('post.index');
Route::get('post/create', [PostsController::class, 'create'])->name('post.create');
Route::get('post/show/{id}', [PostsController::class, 'show'])->name('post.show');
Route::post('post/', [PostsController::class, 'store'])->name('post.store');
 