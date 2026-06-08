<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;

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


    Route::get('/users', function (Request $request) {
        $users = UserResource::collection(User::all());
        return view('Users', [
            'users' => $users,
        ]);
    });

    Route::get('/reports', function (Request $request) {
        $reports = Report::with([
            'user',
            'post',
            'post.user',
            'post.pictures',
        ])->latest()->get();



        $reports = $reports->each(function ($report) {
            dd($report);
            $report->post?->setAttribute(
                'pictures',
                $report->post->pictures->first()?->file_name
            );
        });

        return view('Reports', [
            'reports' => $reports
        ]);
    });

    Route::post('reports/delete', function (Request $request) {
        Post::find($request->post_id)->delete();
        return back();
    });

    Route::post('reports/ignore', function (Request $request) {
        Report::find($request->report_id)->delete();
        return back();
    });

    Route::get('/logout', function (Request $request) {

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    });

    Route::get('/posts', function (Request $request) {
        $posts = Post::query()->with([
            'user',
            'location',
            'category',
            'category',
            'pictures',
        ])->latest()->get();

        $posts = collect($posts)
            ->map(function ($post) {
                $post->pictures = $post->pictures->first()?->file_name;
                return $post;
            });

        return view('Posts', [
            'posts' => $posts,
        ]);
    });
});
