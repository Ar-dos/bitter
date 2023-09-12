<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index']);

Route::group(['middleware'=>'auth:sanctum'], function (){
    Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::post('/user/{user}', [\App\Http\Controllers\UserController::class, 'store']);
    Route::post('/follows', [\App\Http\Controllers\FollowController::class, 'store']);
    Route::delete('/follows', [\App\Http\Controllers\FollowController::class, 'destroy']);
    Route::get('/feed', [\App\Http\Controllers\PostController::class, 'feed']);
});



Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'show']);
Route::get('/posts/tags/{post}', [\App\Http\Controllers\PostController::class, 'tags']);


Route::get('/tags/{tag}', [\App\Http\Controllers\TagController::class, 'show']);
Route::get('/tags', [\App\Http\Controllers\TagController::class, 'index']);

//Route::get('/user', [\App\Http\Controllers\UserController::class, 'index']);
Route::get('/user/{user}', [\App\Http\Controllers\UserController::class, 'show']);
Route::get('/user/{user}/followers', [\App\Http\Controllers\UserController::class, 'followers']);
Route::get('/user/{user}/followings', [\App\Http\Controllers\UserController::class, 'followings']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
