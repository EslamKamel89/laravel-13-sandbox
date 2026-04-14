<?php

namespace App\Http\Controllers;

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
        $posts = Post::with(['user'])
            ->whereHas('user', function ($q) {
                $q->where('name', 'admin');
            })
            ->publish()->get();
        return $posts;
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
}
