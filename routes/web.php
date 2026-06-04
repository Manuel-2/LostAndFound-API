<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
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

    $totalPostCount = Post::count();
    $postsThatRecieveHelp = Post::query()->has('requests')->count();

    $persentageOfPostsHelp = 0;
    if($totalPostCount != 0){
        $persentageOfPostsHelp = $postsThatRecieveHelp * 100 / $totalPostCount;
    }

    $persentageOfPostsHelp = number_format($persentageOfPostsHelp, 2) . "%";

    $objectsRetrived = Post::query()->where('status', 'Resuelto')->count();

    $avgRetriveTime = DB::select(" select avg(m) as minutesTime from
	    (SELECT TIMESTAMPDIFF(Minute,p.created_at ,p.updated_at ) as m from posts p
			where p.status = 'Resuelto'
	    ) as t;
    ")[0]->minutesTime;

    if($avgRetriveTime == null){
        $avgRetriveTime = "Na";
    }


    // datos para graffica de barras
    $daysMap = [
        "lunes" => 0,
        "martes" => 0,
        "miércoles" => 0,
        "jueves" => 0,
        "viernes" => 0,
        "sabado" => 0,
        "domingo" => 0
    ];

    $postPerMonth = [
        1 => 0,  // enero
        2 => 0,  // febrero
        3 => 0,  // marzo
        4 => 0,  // abril
        5 => 0,  // mayo
        6 => 0,  // junio
        7 => 0,  // julio
        8 => 0,  // agosto
        9 => 0,  // septiembre
        10 => 0, // octubre
        11 => 0, // noviembre
        12 => 0, // diciembre
    ];


    $cats = (Category::all()->pluck('name')->toArray());
    $catsMap = array_fill_keys($cats,0);

    Post::all()->map(function ($post) use (&$catsMap, &$daysMap, &$postPerMonth) {
        $incidentDate = Carbon::parse($post->incident_date);
        $day = $incidentDate->locale('es')->translatedFormat("l");
        $month = $incidentDate->monthOfYear();
        $daysMap[$day]++;
        $postPerMonth[$month]++;
        $catsMap[$post->category->name]++;
    });

    $categoriesData = [
        'labels' => array_values($cats),
        'data' => array_values($catsMap)
    ];

    $objectsPerDayData = [
        'labels' => array_keys($daysMap),
        'data' => array_values($daysMap),
    ];

    $postPerMonth = [
        'labels' =>  [
            'enero',
            'febrero',
            'marzo',
            'abril',
            'mayo',
            'junio',
            'julio',
            'agosto',
            'septiembre',
            'octubre',
            'noviembre',
            'diciembre'
        ],
        'data' => array_values($postPerMonth),
    ];



    return view('dashboard', [
        'userCount' => $userCount,
        'totalPostCount' => $totalPostCount,
        'persentageOfPostsHelp' => $persentageOfPostsHelp,
        'objectsRetrived' => $objectsRetrived,
        'avgRetriveTime' => $avgRetriveTime,
        'objectsPerDayData' => $objectsPerDayData,
        'postPerMonth' => $postPerMonth,
        'categoriesData' => $categoriesData,

    ]);
});
