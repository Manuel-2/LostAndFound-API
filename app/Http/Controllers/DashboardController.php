<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Location;
use App\Models\Post;
use App\Models\Request as PostRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    public function dashboard(Request $request)
    {
        $userCount = DB::select('select count(id) as count from users')[0]->count;

        $totalPostCount = Post::count();
        $postsThatRecieveHelp = Post::query()->has('requests')->count();

        $persentageOfPostsHelp = 0;
        if ($totalPostCount != 0) {
            $persentageOfPostsHelp = $postsThatRecieveHelp * 100 / $totalPostCount;
        }

        $persentageOfPostsHelp = number_format($persentageOfPostsHelp, 2) . "%";

        $objectsRetrived = Post::query()->where('status', 'Resuelto')->count();

        $avgRetriveTime = DB::select(" select avg(m) as minutesTime from
	    (SELECT TIMESTAMPDIFF(Minute,p.created_at ,p.updated_at ) as m from posts p
			where p.status = 'Resuelto'
	    ) as t;
    ")[0]->minutesTime;

        if ($avgRetriveTime == null) {
            $avgRetriveTime = "Na";
        }


        // datos para graffica de barras
        $daysMap = [
            "lunes" => 0,
            "martes" => 0,
            "miércoles" => 0,
            "jueves" => 0,
            "viernes" => 0,
            "sábado" => 0,
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
        $catsMap = array_fill_keys($cats, 0);

        $top5Locations = DB::select("
        select l.name ,count(*) as 'count' from posts p
	        join locations l on l.id  = p.location_id
	        group BY l.name
	        limit 5;");

        $top5LocationsData = [
            'labels' => array_map(fn($loc) => $loc->name, $top5Locations),
            'data' => array_map(fn($loc) => $loc->count, $top5Locations),
        ];

        Post::all()->map(function ($post) use (&$catsMap, &$daysMap,  &$postPerMonth) {
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

        $monthPosts = Post::query()->where('incident_date', '>', Carbon::now()->subMonth())->get();


        // otros 4 kpis
        $lostPosts = Post::query()->where('type', "Perdido")->get()->count();
        $foundPosts = Post::query()->where('type', "Encontrado")->get()->count();
        $popularType = DB::select("
        select l.name ,count(*) as 'count' from posts p
	        join categories l on l.id  = p.category_id
	        group BY l.name
       order by count DESC
	        limit 1;");
        $popularType = count($popularType) > 0 ? $popularType[0]->name : "Na";

        $popularLoc = DB::select("
        select l.name ,count(*) as 'count' from posts p
	        join locations l on l.id  = p.location_id
	        group BY l.name
       order by count DESC
	        limit 1;");
        $popularLoc = count($popularLoc) > 0 ? $popularLoc[0]->name : "Na";


        $pendingRequest = PostRequest::query()->where('status', 'Pendiente')->get()->count();

        return view('dashboard', [
            'userCount' => $userCount,
            'totalPostCount' => $totalPostCount,
            'persentageOfPostsHelp' => $persentageOfPostsHelp,
            'objectsRetrived' => $objectsRetrived,
            'avgRetriveTime' => $avgRetriveTime,
            'objectsPerDayData' => $objectsPerDayData,
            'postPerMonth' => $postPerMonth,
            'categoriesData' => $categoriesData,
            'top5LocationsData' => $top5LocationsData,

            'lostPosts' => $lostPosts,
            'foundPosts' => $foundPosts,
            'popularType' => $popularType,
            'popularLoc' => $popularLoc,
            'pendingRequest' => $pendingRequest,
        ]);
    }
    //
}
