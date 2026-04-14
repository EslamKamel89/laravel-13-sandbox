<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Middleware;

#[Middleware('auth:sanctum')]
class PostController extends Controller {
    public function index() {
        // $posts = auth()
        //     ->user()
        //     ->posts()
        //     ->publish()
        //     ->get();
        $posts = Post::with(['user', 'likedByUsers', 'comments'])
            ->publish()
            ->get();
        return PostResource::collection($posts);
    }

    public function create() {
    }

    public function store(Request $request) {
        $validated =  $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $post = auth()->user()->posts()->create($validated);
        return $post;
    }

    public function show(string $id) {
    }

    public function edit(string $id) {
    }

    public function update(Request $request, string $id) {
    }

    public function destroy(string $id) {
    }
    public function toggleLike(Post $post) {
        $like = $post->likes()->where('user_id', auth()->id())->first();
        if ($like == null) {
            $newLike = $post->likes()->create([
                'user_id' => auth()->id(),
            ]);
            return response()->json(['message' => 'post added to likes']);
        }
        $like->delete();
        return response()->json(['message' => 'Post removed from likes']);
    }
    public function addComment(Request $request, Post $post) {
        $validated = $request->validate([
            'content' => ['required']
        ]);
        $post->comments()->create($validated);
        // $validated += [
        //     'commentable_type' => Post::class,
        //     'commentable_id' => $post->id
        // ];
        // Comment::create($validated);
        $post->load(['user', 'likedByUsers', 'comments']);
        return $post;
    }
}
