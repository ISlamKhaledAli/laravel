<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts = [
        ['id' => 1, 'title' => 'Post 1', 'content' => 'Content 1'],
        ['id' => 2, 'title' => 'Post 2', 'content' => 'Content 2'],
        ['id' => 3, 'title' => 'Post 3', 'content' => 'Content 3'],
    ];

    // Index
    public function index()
    {
        return view('posts.index', ['posts' => $this->posts]);
    }

    // Show
    public function show($id)
    {
        $post = collect($this->posts)->firstWhere('id', $id);
        return view('posts.show', compact('post'));
    }

    // Create
    public function create()
    {
        return view('posts.create');
    }

    // Store (fake)
    public function store(Request $request)
    {
        return redirect()->route('posts.index');
    }

    // Edit
    public function edit($id)
    {
        $post = collect($this->posts)->firstWhere('id', $id);
        return view('posts.edit', compact('post'));
    }

    // Update (fake)
    public function update(Request $request, $id)
    {
        return redirect()->route('posts.index');
    }

    // Destroy
    public function destroy($id)
    {
        return redirect()->route('posts.index');
    }
}
