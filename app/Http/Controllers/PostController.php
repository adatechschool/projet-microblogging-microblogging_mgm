<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hashtag;
use Illuminate\Database\Eloquent\Collection;
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
        error_log('error');
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


    public function searchByHashtag(Request $request)
    {
        //Je recupère la valeur de mon input;
        $searchValue = $request->input('search-value');

        // $hashtag = Hashtag::where('name', $searchValue)->first();
        $hashtags = Hashtag::where('name', 'ILIKE', '%' . $searchValue . '%')->get();

        // Récupérer tous les posts liés à ce hashtag via la relation polymorphe
        $posts = new Collection();
        foreach ($hashtags as $hashtag) {
            $_postsByHashtag = $hashtag->posts;
            $posts = $posts->merge($_postsByHashtag);
        }
        $_usersPosts = app('App\Http\Controllers\UserController')->searchByUserName($searchValue);
        $posts = $posts->merge($_usersPosts);

        return view('posts.index', compact('posts'));
    }
}
