<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::all();
        return($tags);
    }

    public function show(PostService $service, string $title) {
        $posts = Tag::where('title',$title)->first()->posts;

        return $service->attachUsernameAndTags($posts);
    }
}
