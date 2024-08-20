<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hashtag;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hashtags' => 'nullable|string'
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => auth()->id()
        ]);

        // Gestion de l'ajout de la photo
        if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $fileName);

            // Enregistrer le nom de la photo dans la base de données
            $post->photo = $fileName;  
            $post->save();
    }

        $hashtags = explode(',', $request->input('hashtags'));

        foreach ($hashtags as $hashtag) {
            $tag = Hashtag::firstOrCreate(['name' => trim($hashtag, '# ')]);
            $post->hashtags()->attach($tag);
        }

        return redirect()->route('posts.index')->with('status', 'Post created successfully!');
    }

    public function destroy($id)
{
    $post = Post::findOrFail($id);

    // Si le post a une photo, supprimez-la du serveur
    if ($post->photo) {
        $photoPath = public_path('uploads/' . $post->photo);
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
    }

    // Supprimer le post de la base de données
    $post->delete();

    return redirect()->route('posts.index')->with('status', 'Post deleted successfully!');
}


public function searchByHashtag($hashtagName)
    {
        $hashtag = Hashtag::where('name', $hashtagName)->first();

        if (!$hashtag) {
            return redirect()->route('posts.index')->with('status', 'No posts found for this hashtag.');
        }

        // Récupérer tous les posts liés à ce hashtag via la relation polymorphe
        $posts = $hashtag->posts;

        return view('posts.index', compact('posts'));
    }

}
