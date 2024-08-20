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

    // Relation pour les posts likés
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    public function hasLiked(Post $post)
    {
        return $this->likes->contains($post);
    }

    // Relation pour les abonnements
    // users que le user connecté suit
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    // users qui suivent le user connecté
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    // Relation pour les préférences
    public function hashtags()
    {
        return $this->morphToMany(Hashtag::class, 'hashtagable');
    }
}
/**
 * 
 * 
 * ?>

// <!-- Code pour la seconde Navbar-->
// <nav>
    // <ul>
        // <li><a href="{{ route('home') }}">Publications</a></li>
        // <li><a href="{{ route('profile') }}">Followers</a></li>
        // <li><a href="{{ route('posts.index') }}">Suivi(e)s</a></li>

        // </ul>
    // </nav>

// <?php

 */
