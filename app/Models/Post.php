<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Guarded([])]
class Post extends Model
{

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }


    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmarks::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
