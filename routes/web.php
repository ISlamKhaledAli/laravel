<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::patch('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');