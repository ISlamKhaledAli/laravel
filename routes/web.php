<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

$posts = [
    [
        'id' => 1,
        'title' => 'The Power of Eloquent',
        'content' => 'Eloquent ORM provides a beautiful, simple ActiveRecord implementation for working with your database.',
    ],
    [
        'id' => 2,
        'title' => 'Middleware Explained',
        'content' => 'Middleware provide a convenient mechanism for inspecting and filtering HTTP requests entering your application.',
    ],
    [
        'id' => 3,
        'title' => 'Mastering Migrations',
        'content' => 'Migrations are like version control for your database, allowing your team to modify and share the application database schema.',
    ],
];

Route::get('/posts', function () use ($posts) {
    return view('posts.index', compact('posts'));
})->name('posts.index');

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');

Route::get('/posts/{id}', function ($id) use ($posts) {
    $post = collect($posts)->firstWhere('id', (int) $id);

    abort_unless($post, 404);

    return view('posts.show')->with('post', $post);
})->whereNumber('id')->name('posts.show');
