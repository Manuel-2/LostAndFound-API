<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
        if($picture){
            $picture = $picture[0];
        }else{
            $picture = null;
        }

        return [
            "id" => 13,
            "user_id" => $this->user->id,
            "title" => $this->title,
            "description" => $this->description,
            "category" => $this->category,
            "incident_date" => $this->incident_date,
            "type" => $this->type,
            "picture" => $picture,
        ];
    }
}
