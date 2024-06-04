<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function store(StoreFollowRequest $request)
    {
        return DB::table('follows')->insertGetId($request->validated());
    }

    public function destroy(StoreFollowRequest $request)
    {
        $followed_id =  $request->get('followed_user_id');
        $following_id =  $request->get('following_user_id');
        $follows = DB::table('follows')
            ->where('followed_user_id', '=', $followed_id)
            ->where('following_user_id', '=',  $following_id )
            ->delete();
        return $follows;
    }
}
