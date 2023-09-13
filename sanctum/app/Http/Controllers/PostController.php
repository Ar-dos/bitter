<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{

    public function index(PostService $service) {
        return $service->index();
    }

    public function show(Post $post) {
        return [$post, $post->user()];
    }

    public function tags(Post $post) {
        return $post->tags()->get();
    }

    public function store(StorePostRequest $request, PostService $service) {
        $post = $service->store($request->validated());
    }

    public function feed(PostService $service) {
        return $service->feed(auth()->id());
    }
}
