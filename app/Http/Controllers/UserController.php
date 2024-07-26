<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showPosts(int $userId)
    {
        // Trouver l'utilisateur par ID
        $user = User::findOrFail($userId);

        // Récupérer les posts de l'utilisateur
        $posts = $user->posts;

        // Passer les données à la vue
        return view('posts.user-posts', compact('user', 'posts'));
    }
}
