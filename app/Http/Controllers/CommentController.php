<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|min:3',
            'user_id' => 'required|exists:users,id',
        ]);

        $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->input('user_id'),
        ]);

        return back();
    }
}
