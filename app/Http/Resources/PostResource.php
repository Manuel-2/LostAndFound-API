<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use Carbon\Carbon;

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

        Carbon::setLocale('es');
        return [
            "id" => $this->id,
            "hidden_user" => ($user == null),
            "user" => $user,
            "title" => $this->title,
            "description" => $this->description,
            "category" => $this->category,
            "location" => $this->location,
            // "incident_date" => $this->incident_date,
            "incident_date" => new Carbon($this->created_at)->diffForHumans(),
            "type" => $this->type,
            "picture" => $picture,
            "yours" => $yours,
            "bookmarked" => $this->bookmarked,
            "status" => $this->status,
        ];
    }
}
