<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Picture;
use App\Models\Post;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function report(Request $request, Post $post)
    {

        $report = Report::create([
            'user_id' => $request->user()->id,
            'post_id' => $post->id,
            'reason' => $request->reason
        ]);


        return response()->json([
            'message' => "Post denunciado correctamente"
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::query()->latest();

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
                $posts->where('created_at', ">", $today->subMonth()->toDateString());
            } else if ($time == "esta semana") {
                $posts->where('created_at', ">", $today->subWeek()->toDateString());
            } else if ($time == 'hoy') {
                $posts->whereDate('created_at', $today->toDateString());
            } else if ($time != "todo el tiempo") {
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

    public function userIndex(Request $request)
    {
        $posts = Post::query()->where('user_id', $request->user()->id);

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

        $post = new Post($request->except(['picture', 'share_my_data']));
        $post->share_my_data = $request->boolean('share_my_data');
        $post->user_id = $request->user()->id;
        $post->save();

        if ($request->has('picture')) {
            $file = $request->file('picture');
            $hash = hash_file('sha256', $file->getRealPath());
            $ext = $file->extension();
            $storageName = "{$hash}.{$ext}";

            $path = Storage::disk('s3')->putFileAs(
                'pictures',
                $file,
                $storageName,
            );

            Picture::create([
                'post_id' => $post->id,
                'file_name' => $path
            ]);
        }

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

    public function complete(Post $post, Request $request)
    {
        $owner = $post->user;
        if ($request->user()->id != $owner->id) {
            return response()->json([
                'message' => "Este no es tu post no puedes marcarlo como completado"
            ], 400);
        }

        $post->status = "Resuelto";
        $post->save();

        return response()->json([
            'message' => "Post marcado como resuelto"
        ]);
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
