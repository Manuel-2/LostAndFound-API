<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function userPosts(Request $request){
        return response()->json([
            'data' => $request->user()->posts
        ]);
    }

    public function show(Request $request)
    {
        return $request->user()->toResource();
    }

    public function update(Request $request)
    {
        $fields = $request->validate([
            'name' => ['min:4'],
            'phone' => ['size:10'],
            'picture' => ['image'],
        ]);


        $user = $request->user();

        $user->name = $fields['name'];
        $user->phone = $fields['phone'];

        if ($request->has('picture')) {
            $file = $request->file('picture');
            $hash = hash_file('sha256', $file->getRealPath());
            $ext = $file->extension();
            $storageName = "{$hash}.{$ext}";

            $path = Storage::disk('s3')->putFileAs(
                'profile',
                $file,
                $storageName,
            );
            $user->picture = $path;
        }
        $user->save();

        return response()->json([
            'data' => $user->toResource(),
            'message' => "Usuario editado correctamente."
        ]);
    }
}
