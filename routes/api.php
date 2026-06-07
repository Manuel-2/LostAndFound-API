<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// sin sesion iniciada
Route::post('/login', [AuthController::class, 'login']);
Route::post('/sign-up', [AuthController::class, 'signUp']);

// con sesion
Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout']);

    Route::get('/user', [UserController::class, 'show']);
    Route::patch('/user', [UserController::class, 'update']);
    Route::get('/user/posts', [PostController::class, 'userIndex']);
    Route::get('/user/saved-posts', [PostController::class, 'savedPosts']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/locations', [LocationController::class, 'index']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::patch('/posts/{post}/complete', [PostController::class, 'complete']);
    Route::post('/posts/{post}/bookmark', [PostController::class, 'createBookmark']);
    Route::post('/posts/{post}/report', [PostController::class, 'report']);


    Route::get('/requests', [RequestController::class, 'index']);
    Route::get('/requests/{postRequest}', [RequestController::class, 'show']);
    Route::post('/requests', [RequestController::class, 'store']);
    Route::patch('/requests/{postRequest}/accept', [RequestController::class, 'accept']);
    Route::patch('/requests/{postRequest}/decline', [RequestController::class, 'decline']);

    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'read']);
});
