<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    // Index
    public function index()
    {
        $posts = Post::withTrashed()->with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Show
    public function show($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $users = User::all();
        return view('posts.show', compact('post', 'users'));
    }

    // Create
    public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }

    // Store
    public function store(StorePostRequest $request)
    {
        Post::create($request->validated());
        return redirect()->route('posts.index');
    }

    // Edit
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    // Update
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->validated());
        return redirect()->route('posts.index');
    }

    // Destroy
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }

    // Restore
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.index');
    }
}
