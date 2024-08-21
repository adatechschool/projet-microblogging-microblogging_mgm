<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hashtag;
use Illuminate\Database\Eloquent\Collection;
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

    public function updateHashtags(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $request->validate([
            'hashtags' => 'nullable|string'
        ]);

        $hashtags = explode(',', $request->input('hashtags'));

        // Detach existing hashtags
        $user->hashtags()->detach();

        foreach ($hashtags as $hashtag) {
            $tag = Hashtag::firstOrCreate(['name' => trim($hashtag, '# ')]);
            $user->hashtags()->attach($tag);
        }

        return redirect()->back()->with('status', 'Hashtags updated successfully!');
    }
    public static function searchByUserName(string $name)
    {
        //Je viens rechercher tous les users contenant la valeur de mon input.
        //Je fais un ilike pour ne pas avoir a donner le nom exact
        //ILIKE Permet de rechercher un groupe caractère sans tenir compte de la Case (majuscule ou minuscule)
        $users = User::where('name', 'ILIKE', '%' . $name . '%')->get();

        $posts = new Collection();
        //Pour chacun de users, je vais chercher leurs posts.
        //Je viens concatener les posts
        foreach ($users as $user) {
            $tmp = $user->posts;

            $posts = $posts->merge($tmp);
        }
        return $posts;
    }
}
