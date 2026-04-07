<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Index
    public function index()
    {
        $posts = Post::withTrashed()->with('user')->latest()->paginate(5);
        return view('dashboard', compact('posts'));
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
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);
        return redirect()->route('dashboard');
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
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);
        return redirect()->route('dashboard');
    }

    // Destroy
    public function destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if (auth()->id() !== $post->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $post->delete();
        return redirect()->route('dashboard');
    }

    // Restore
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('dashboard');
    }
}
