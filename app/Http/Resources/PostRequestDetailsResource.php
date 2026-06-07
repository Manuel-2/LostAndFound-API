<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostRequestDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //TODO: validar y ocultar la informacion del usuariio segun sea necesario

        $type = $this->post->type;
        if ($type == "Perdido") {
            $type = "Información sobre objeto";
        } else {
            $type = "Solicitud de reclamación";
        }


        $user = null;
        if ($this->status == 'Aprobada') {
            $user = User::find($this->user_id);
        }

        $objectName = $this->post->title;

        Carbon::setLocale('es');
        return [
            "id" => $this->id,
            "type" => $type,
            "status" => $this->status,
            "title" => $objectName,
            "post" => $this->post->toResource(),
            'content' => $this->content,
            'message' => $this->message,
            'user' => $user,
            "time" => $this->created_at->diffForHumans(),
        ];
    }
}
