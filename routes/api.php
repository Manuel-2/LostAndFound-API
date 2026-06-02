<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// sin sesion iniciada
Route::post('/login', [AuthController::class, 'login']);
Route::post('/sign-up', [AuthController::class, 'signUp']);

// con sesion
Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/locations', [LocationController::class, 'index']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/posts', [PostController::class, 'store']);


    Route::get('/requests', [RequestController::class, 'index']);
    Route::get('/requests/{postRequest}', [RequestController::class, 'show']);
    Route::post('/requests', [RequestController::class, 'store']);
    Route::patch('/requests/{postRequest}/accept', [RequestController::class, 'accept']);
    Route::patch('/requests/{postRequest}/decline', [RequestController::class, 'decline']);

    Route::get('/notifications', [NotificationController::class, 'index']);
});
