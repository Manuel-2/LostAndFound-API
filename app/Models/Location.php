<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'description'];


    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    //
}
