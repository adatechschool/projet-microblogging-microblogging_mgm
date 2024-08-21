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
        //On récupère le user qui fait la requete
        $authenticatedUser = Auth::user();

        //On récupère le model user associé à celui qui fait la requete
        //Même si la donnée est la même, c'est le modèle User qui possède la méthode has_liked.
        $user = User::find($authenticatedUser->id);
        // Empêcher l'utilisateur de liker son propre post
        if ($post->user_id == $authenticatedUser->id) {
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
        $authenticatedUser = Auth::user();

        $user = User::find($authenticatedUser->id);

        // Vérifier si l'utilisateur a déjà liké ce post
        if (!$user->hasLiked($post)) {
            return redirect()->back()->with('error', 'You have not liked this post.');
        }

        // Supprimer le like de la relation de pivot
        $user->likes()->detach($post->id);

        return redirect()->back()->with('success', 'Post unliked.');
    }
}
