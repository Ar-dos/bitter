<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\ErrorHandler\Collecting;

class PostService
{
    public function attachUsernameAndTags($posts) {
        $result = Array();
        foreach ($posts as $post) {
            $data = json_decode($post,true);
            $data['user'] = $post->user()->first();
            $data['tags'] = $post->tags()->get();
            $data['mentions'] = $post->mentions()->get(['name']);
            $data['created_at'] = Carbon::parse($data['created_at'])->format('h:m d.m.y');
            $result[] = $data;
        }
        return $result;
    }

    private function createTagsFromText(string $text) {
        preg_match_all("/#(\\w+)/", $text, $matches);
        $tagsId = [];
        foreach (array_unique($matches[1]) as $match) {
            $tagsId[] = Tag::firstOrCreate([
                'title' => $match
            ])->id;
        }
        return $tagsId;
    }

    private function createMentionsFromText(string $text) {
        preg_match_all("/@(\\w+)/", $text, $matches);
        $followsId = [];
        foreach (array_unique($matches[1]) as $match) {
           $user = User::where('name',$match)->first();
            if ($user) {
                $followsId[] = $user->id;
            }
        }
        return $followsId;
    }



    public function index() {
        // TODO : move to repository

        $posts = Post::orderBy('created_at','DESC')->get();
        return $this->attachUsernameAndTags($posts);
    }

    public function store(array $postData): Post
    {
        // TODO : move to repository

        $post = Post::create($postData);

        $post->tags()->attach($this->createTagsFromText($postData['body']));
        $post->mentions()->attach($this->createMentionsFromText($postData['body']));

        return $post;
    }

    public function feed($user_id) {
        $user = User::find($user_id);
        $users = $user->posts()->get();
        $mentions = $user->mentionedInPosts()->get();

        $follows = new Collection();

        foreach ($user->followings as $following) {
            foreach ($following->posts as $posts) {
                $follows[] = $posts;
            }
        }

        $collection = new Collection();

        $collection = $collection->merge($users);
        $collection = $collection->merge($mentions);
        $collection = $collection->merge($follows);

        return $this->attachUsernameAndTags($collection->sortByDesc('created_at'));
    }
}
