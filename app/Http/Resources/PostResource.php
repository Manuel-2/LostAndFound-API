<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $picture = PictureResource::collection($this->pictures);
        if (count($picture)) {
            $picture = $picture[0];
        } else {
            $picture = null;
        }

        $yours = $this->user->id == $request->user()->id;

        $user = null;
        if ($this->share_my_data) {
            $user = $this->user->toResource();
        }

        return [
            "id" => $this->id,
            "hidden_user" => ($user == null),
            "user" => $user,
            "title" => $this->title,
            "description" => $this->description,
            "category" => $this->category,
            "location" => $this->location,
            "incident_date" => $this->incident_date,
            "type" => $this->type,
            "picture" => $picture,
            "yours" => $yours,
        ];
    }
}
