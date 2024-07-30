<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hashtag;
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

}
