<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relation pour les posts
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    //Relation entre User et Like
    // un user peut avoir plusieurs "like" => fonction likes permet de récupérer tous les likes donnés par user
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    //Relation entre User et Post via la table pivot Like
    // user peut liker plusieurs posts
    public function likedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    //fonction qui vérifie si l'utilisateur a liké un post spécifique
    public function hasLiked(Post $post): bool
    {
        return $this->likedPosts()->where('post_id', $post->id)->exists();
    }

    // Relation pour les abonnements
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    // Relation pour les préférences
    public function hashtags()
    {
        return $this->morphToMany(Hashtag::class, 'hashtagable');
    }
}

