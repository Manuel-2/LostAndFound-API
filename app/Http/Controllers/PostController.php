<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Picture;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::query()->latest();
        //TODO: agregar filtros opcionales

        if ($request->filled("category_id")) {
            $posts->where("category_id", $request->query('category_id'));
        }

        if ($request->filled("location_id")) {
            $posts->where("location_id", $request->query('location_id'));
        }


        if ($request->filled('time')) {
            $time = strtolower($request->query('time'));
            $today = Carbon::now();
            if ($time == 'este mes') {
                $posts->where('incident_date', ">", $today->subMonth()->toDateString());
            } else if ($time == "esta semana") {
                $posts->where('incident_date', ">", $today->subWeek()->toDateString());
            } else if ($time == 'hoy') {
                $posts->where('incident_date', $today->toDateString());
            } else if ($time != "todo") {
                return response()->json([
                    'message' => "Tiempo no valido",
                ], 400);
            }
        }

        $posts =  $posts->get();

        return response()->json([
            'data' => PostResource::collection($posts),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post($request->except(['picture','share_my_data']));
        $post->share_my_data = $request->boolean('share_my_data');
        $post->user_id = $request->user()->id;
        $post->save();

        if ($request->has('picture')) {
            $file = $request->file('picture');
            $hash = hash_file('sha256', $file->getRealPath());
            $ext = $file->extension();
            $storageName = "{$hash}.{$ext}";

            Picture::create([
                'post_id' => $post->id,
                'file_name' => $storageName
            ]);
            $file->storePubliclyAs($storageName);

            Storage::disk('public')->putFileAs(
                'pictures',
                $file,
                $storageName
            );
        }

        //TODO ahcer picture resource
        // $post->load('pictures:id');

        return response()->json([
            'message' => "Publicacion guardada con exito",
            'data' => $post->toResource()
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json([
            'data' => $post->toResource()
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
