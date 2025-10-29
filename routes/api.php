<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::post('/', [PostController::class, 'store']);
    Route::get('/{post}', [PostController::class, 'show']);
    Route::put('/{post}', [PostController::class, 'update']);
    Route::patch('/{post}', [PostController::class, 'update']);
    Route::delete('/{post}', [PostController::class, 'destroy']);
});

Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
Route::match(['put', 'patch'], '/comments/{comment}', [CommentController::class, 'update']);
Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);

// Route::middleware('auth:api')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
//     Route::get('/comments/{comment}', [CommentController::class, 'show']);
// });

/*
Route::get('/users', fn() => User::with('posts.comments')->get());
Route::get('/posts', fn() => Post::with('user','comments')->get());
Route::get('/comments', fn() => Comment::with('post.user')->get());

Route::get('/ping', function () {
   return response()->json(['message' => 'pingpong']);
});

Route::get('/status', function () {
    return response()->json([
        'app' => 'Todo API',
        'status' => 'running'
    ]);
});

Route::get('/greet/{name}', function ($name) {
    return response()->json([
        'message' => "Hello, {$name}"
    ]);
});

Route::get('/user/{id}/posts', function ($id) {
    $user = User::with('posts.comments')->find($id);

    if (!$user) {
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    return response()->json($user->posts);
});

Route::get('/post/{id}/comments', function ($id) {
    $post = Post::with('comments')->find($id);

    if (!$post) {
        return response()->json([
            'message' => 'Post not found'
        ], 404);
    }

    return response()->json($post->comments);
});
*/