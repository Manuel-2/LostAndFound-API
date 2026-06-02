<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();
        $notificaitons = Notification::query()->where('user_id', $user->id)->get();

        return response()->json([
            'data' => NotificationResource::collection($notificaitons)
        ]);
    }

    public function read(Notification $notification)
    {
        $notification->is_read = true;
        $notification->save();

        return response()->json([
            'message' => "Notificaion marcada como leida",
        ]);
    }
}
