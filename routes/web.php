<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostsController::class, 'index']);
Route::get('post/', [PostsController::class, 'index'])->name('post.index');
 