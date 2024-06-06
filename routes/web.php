<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostsController::class, 'index']);
Route::get('post/', [PostsController::class, 'index'])->name('post.index');
Route::get('post/create', [PostsController::class, 'create'])->name('post.create');
Route::get('post/show/{id}', [PostsController::class, 'show'])->name('post.show');
Route::get('post/edit/{id}', [PostsController::class, 'edit'])->name('post.edit');
Route::post('post/', [PostsController::class, 'store'])->name('post.store');
Route::patch('post/show/{id}', [PostsController::class, 'update'])->name('post.update');
Route::delete('post/{id}', [PostsController::class, 'destroy'])->name('post.destroy');
 