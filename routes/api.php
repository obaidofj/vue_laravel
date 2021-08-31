<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('posts',[PostController::class, 'index']);


Route::post('login',[UserController::class,'login']);

Route::post('register',[UserController::class,'register']);
Route::get('checkEmailExist/{email}',[UserController::class,'checkEmailExist']);


Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class,'details']);
    Route::apiResource('posts',PostController::class);
    Route::get('category/{slug}/posts',[PostController::class,'catgPosts']);
Route::get('searchposts/{query}',[PostController::class,'searchPosts']);
Route::apiResource('categories',CategoriesController::class);
Route::post('comment/create',[CommentController::class,'store']);
});