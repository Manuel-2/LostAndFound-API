<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{

    protected $messages = [
        'Solicitud aprobada' => "Ya puedes ver la información de contacto del propietario.",
        'Solicitud rechazada' => "Te rechazaron la solicitud, no puedes proceder.",
        'Sistema' => "message",
        'Posible coincidencia' => "Encontramos una publicación que podría coincidir con tu objeto perdido.",
    ];


    public function toArray(Request $request): array
    {
        Carbon::setLocale('es');

        $description = $this->messages[$this->type];

        return [
            "id" => $this->id,
            "type" => $this->type,
            "description" => $description,
            "is_read" => $this->is_read,
            "post_id" => $this->post_id,
            "time" => $this->created_at->diffForHumans(),
        ];
    }
}
