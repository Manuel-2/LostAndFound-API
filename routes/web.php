<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

Route::redirect('/', '/dashboard');

Route::middleware('guest')->group(function () {

    Route::view('/login', 'login')
        ->name('view.login');

    Route::post('/login', [AuthController::class, 'webLogin'])
        ->name('login');

    Route::view('/recover', 'recover-password')
        ->name('view.recover-password');

    Route::post('/recover', [AuthController::class, 'recoverPassword']);

    Route::get('/reset-password', function (Request $request) {
        return view('reset-password', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    })->name('password.reset');

    Route::post('/password-update', [AuthController::class, 'updatePassword']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');

});
