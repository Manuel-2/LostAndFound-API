<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // si la solicitud eta aceptada si mostar el nombre del usuario
        $type = $this->post->type;
        if ($type == "Perdido") {
            $type = "Información sobre objeto";
        } else {
            $type = "Solicitud de reclamación";
        }

        $user_name = "Contacto a revelar";
        if ($this->status == 'Aprobada') {
            $user_name = User::find($this->user_id)->name;
        }

        $objectName = $this->post->title;

        Carbon::setLocale('es');
        return [
            "id" => $this->id,
            "type" => $type,
            "status" => $this->status,
            "title" => $objectName,
            "user_name" => $user_name,
            "time" => $this->created_at->diffForHumans(),
        ];
    }
}
