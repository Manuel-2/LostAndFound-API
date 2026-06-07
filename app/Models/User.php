<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password', 'phone'])]
#[Hidden(['password', 'remember_token', 'created_at', 'updated_at', 'email_verified_at'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    public function savedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'bookmarks');
    }


    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmarks::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
