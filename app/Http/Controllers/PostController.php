<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hashtag;
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
            'body' => 'required|string',
            'hashtags' => 'nullable|string'
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => auth()->id()
        ]);

        $hashtags = explode(',', $request->input('hashtags'));

        foreach ($hashtags as $hashtag) {
            $tag = Hashtag::firstOrCreate(['name' => trim($hashtag, '# ')]);
            $post->hashtags()->attach($tag);
        }

        return redirect()->route('posts.index')->with('status', 'Post created successfully!');
    }

}

