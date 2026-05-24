<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Picture;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //TODO: agregar filtros opcionales

        return response()->json([
            'data' => Post::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post($request->except(['picture']));
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
    public function show(string $id)
    {
        //
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
