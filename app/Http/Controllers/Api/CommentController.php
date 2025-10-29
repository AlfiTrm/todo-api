<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // GET /api/posts/{post}/comments
    public function index(Post $post)
    {
        $comments = $post->comments()->latest()->get();

        return response()->json([
            'message' => 'Daftar komentar untuk post',
            'data' => $comments
        ]);
    }

    // POST /api/posts/{post}/comments
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'content' => 'required|string|max:255',
        ]);

        $comment = $post->comments()->create($validated);

        return response()->json([
            'message' => 'Komentar berhasil dibuat',
            'data' => $comment
        ], 201);
    }

    // GET /api/comments/{comment}
    public function show(Comment $comment)
    {
        $comment->load('post');

        return response()->json([
            'message' => 'Detail komentar',
            'data' => $comment
        ]);
    }

    // PUT/PATCH /api/comments/{comment}
    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'author' => 'sometimes|required|string|max:100',
            'content' => 'sometimes|required|string|max:255',
        ]);

        $comment->update($validated);

        return response()->json([
            'message' => 'Komentar berhasil diupdate',
            'data' => $comment
        ]);
    }

    // DELETE /api/comments/{comment}
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Komentar berhasil dihapus'
        ], 200);
    }
}
