<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    // si esta autenticado dashboard si no login
    return view('login');
});

Route::post('/login', function () {
    // crear cookies y session
    return response()->json(['test' => 'yeahhh']);
});


Route::get('/dashboard', function () {

    // si esta autenticado dashboard si no login
    return view('dashboard', ['test' => [100, 200]]);
});

Route::get('/', function () {
    // si esta autenticado dashboard si no login
    $userCount = DB::select('select count(id) as count from users')[0]->count;
    $postCount = DB::select('select count(id) as count from users')[0]->count;

    $totalPostCount = Post::count();
    $postsThatRecieveHelp = Post::query()->has('requests')->count();

    $persentageOfPostsHelp = $postsThatRecieveHelp * 100 / $totalPostCount;
    $persentageOfPostsHelp = number_format($persentageOfPostsHelp,2) . "%";




    $dataTest = [
        [
            'name' => "hola",
            'value' => 100,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],
        [
            'name' => "hola",
            'value' => 200,
        ],

    ];
    return view('dashboard', ['test' => $dataTest]);
});
