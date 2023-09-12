<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $user = User::find(1);

        return($user->posts);
    }

    // TODO : code duplication in ALL controllers

    public function show(PostService $service,string $username) {
        $posts =  User::where('name',$username) -> first()->posts;

        return $service->attachUsernameAndTags($posts);
    }

    public function followers(string $username) {
        if ($username == ' ')
            return null;
        return User::where('name',$username) -> first()->followers()->get();
    }

    public function followings(string $username) {
        if ($username == ' ')
            return null;
        $user = User::where('name',$username) -> first();
        if ($user)
            return $user->followings()->get();
        else
            return null;
    }

}
