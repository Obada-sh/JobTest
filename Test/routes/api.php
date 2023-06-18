<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsConfirmation;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShowNonPublishedPostsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registeruser' , [RegisterController::class,'register']);

Route::post('/login',[LoginController::class ,'login']);


Route::middleware('auth:sanctum')->post('/post' , [PostController::class,'post']);

Route::middleware(['auth:sanctum','adminAccess'])->group(function(){

    Route::get('/show',[ShowNonPublishedPostsController::class ,'show']);
    Route::post('/allaw/{id}',[PostsConfirmation::class ,'allaw']);
    Route::post('/disallaw/{id}',[PostsConfirmation::class ,'disallaw']);
});

Route::get('/posts', [PostController::class, 'show'])->name('posts.show');
