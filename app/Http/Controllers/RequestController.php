<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostRequestDetailsResource;
use App\Http\Resources\PostRequestResource;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Request as PostRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{

    public function index(Request $request)
    {
        // listar las peiticiones de tus post
        $owner = $request->user();

        $postRequests = PostRequest::query()->latest()->whereHas(
            'post',
            function ($postQuery) use ($owner) {
                $postQuery->where('user_id', $owner->id);
            }
        );

        $postRequests = $postRequests->get();

        return response()->json([
            'data' => PostRequestDetailsResource::collection($postRequests)
        ]);
    }

    public function show(PostRequest $postRequest)
    {
        // TODO validar que la solicitud pertencesca a uno de los posts del usuario autenticado
        return response()->json([
            "data" => $postRequest->toResource(PostRequestDetailsResource::class)
        ]);
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'content' => ['required', 'string'],
            'post_id' => ['required', 'exists:posts,id'],
        ]);


        //TOOD: validar que el post no este resuelto xd

        $user = $request->user();
        $post = Post::find($request->post_id);

        if ($user->id == $post->user->id && env("APP_DEBUG", false) == false) {
            return response()->json([
                'message' => "No puedes hacerte solicitudes a ti mismo. cheka eso en la interfaz cris que no se pueda XD."
            ], 400);
        }

        $postRequest = new PostRequest();
        $postRequest->content = $request->content;
        $postRequest->message = $request->message;
        $postRequest->post_id = $request->post_id;
        $postRequest->user()->associate($user);
        $postRequest->status = "Pendiente";
        $postRequest->save();

        return response()->json([
            'message'  => "Se ha enviado al solicitud.",
        ]);
    }

    public function accept(PostRequest $postRequest, Request $request)
    {
        return $this->handlePostRequest($postRequest, $request, true);
    }

    public function decline(PostRequest $postRequest, Request $request)
    {
        return $this->handlePostRequest($postRequest, $request, false);
    }

    private function handlePostRequest(PostRequest $postRequest, Request $request, $accept)
    {
        if ($postRequest->status != 'Pendiente') {
            return response()->json([
                'message' => "Esta solicitud ya fue rechazada/aprobada"
            ], 400);
        }
        //validar que le pertenesca al usuario;
        $user = $request->user();
        $owner = $postRequest->post->user;
        if ($user->id != $owner->id) {
            return response()->json([
                'message' => "El post no te pernece papu >:(",
            ], 400);
        }

        $postRequest->status = 'Rechazada';
        if ($accept) {
            $postRequest->status = 'Aprobada';
        }

        $postRequest->save();

        // notificar al quiene envio la peticion
        $theOneWhoSendIt = $postRequest->user;
        $type = "Solicitud rechazada";
        if ($accept) {
            $type = "Solicitud aprobada";
        }
        $notification = new Notification([
            'type' =>  $type,
            'user_id' =>  $theOneWhoSendIt->id,
            'post_id' =>  $postRequest->post->id,
        ]);
        $notification->save();

        return response()->json([
            'message' => $type
        ], 201);
    }
}
