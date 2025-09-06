<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        $request->validate([
            'body' => 'required|string'
        ]);

        // Cari post berdasarkan slug
        $post = Post::where('slug', $slug)->firstOrFail();

        Comment::create([
            'post_id' => $post->id, // gunakan ID post
            'user_id' => Auth::id(),
            'body'    => $request->body
        ]);

        return back()->with('success', 'Comment added!');
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string'
        ]);

        $parentComment = Comment::findOrFail($id);

        if ($parentComment->replies()->exists()) {
            return back()->with('error', 'This comment already has a reply.');
        }

        Comment::create([
            'post_id'   => $parentComment->post_id, // tetap pakai ID post
            'user_id'   => Auth::id(),
            'parent_id' => $id,
            'body'      => $request->body
        ]);

        return back()->with('success', 'Reply added!');
    }
}
