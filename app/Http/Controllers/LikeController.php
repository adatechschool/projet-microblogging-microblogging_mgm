<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        $user = Auth::user();

        // Empêcher l'utilisateur de liker son propre post
        if ($post->user_id == $user->id) {
            return redirect()->back()->with('error', 'You cannot like your own post.');
        }

        // Vérifier si l'utilisateur a déjà liké ce post
        if ($user->hasLiked($post)) {
            return redirect()->back()->with('status', 'You already liked this post.');
        }

        $user->likes()->attach($post->id);

        return redirect()->back()->with('status', 'Post liked successfully!');
    }

    public function unlike(Post $post)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur a déjà liké ce post
        if (!$user->hasLiked($post)) {
            return redirect()->back()->with('error', 'You have not liked this post.');
        }

        // Supprimer le like de la relation de pivot
        $user->likes()->detach($post->id);

        return redirect()->back()->with('success', 'Post unliked.');
    }
}
