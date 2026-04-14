<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/posts/{post}/like', [PostController::class, 'toggleLike']);
Route::post('/posts/{post}/comment', [PostController::class, 'addComment']);
Route::resource('/posts', PostController::class);
