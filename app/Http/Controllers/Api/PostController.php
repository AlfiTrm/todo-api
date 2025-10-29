<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Simpan Post
    public function store(Request $request)
    {
        // Validasi sederhana
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        
        // Simpan ke database
        $post = Post::create($validated);

        return response()->json([
            'message' => 'Post berhasil dibuat',
            'data' => $post
        ], 201);
    }

    //GET /api/posts
    public function index()
    {   
        // ambil semua post dengan relasi user & comments
        $posts = Post::with('user','comments')->latest()->get();
    
        return response()->json([
            'message' => 'Daftar semua post',
            'data' => $posts
        ]);
    }

    //GET /api/posts/{post}
    public function show(Post $post)
    {
        // ambil post tertentu dengan relasi user & comments
        $post->load('user','comments');

        return response()->json([
            'message' => 'Detail post',
            'data' => $post
        ]);
    }

    //PUT/PATCH /api/posts/{post}
    public function update(Request $request, Post $post)
    {
        // Validasi sederhana
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
        ]);
        
        // Update post
        $post->update($validated);

        return response()->json([
            'message' => 'Post berhasil diupdate',
            'data' => $post
        ]); 
    }

    //DELETE /api/posts/{post}
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Post berhasil dihapus'
        ]);
    }
}
