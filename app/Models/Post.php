<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function isLikedBy(User $user)
    {
        return $this->likes->contains($user);
    }

    // Vérifier si un utilisateur spécifique a aimé ce post
    // public function hasLiked(User $user)
    // {
    //     return $this->likes->contains($user);
    // }

    public function hashtags()
    {
        return $this->morphToMany(Hashtag::class, 'hashtagable');
    }
}
