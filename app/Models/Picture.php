<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Guarded([])]
class Picture extends Model
{
    public function post() : BelongsTo{
        return $this->belongsTo(Post::class);
    }
    //
}
