<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts of {{ $user->name }}</title>
</head>
<body>
    <h1>Posts of {{ $user->name }}</h1>

    @if ($posts->isEmpty())
        <p>No posts found for this user.</p>
    @else
        <ul>
            @foreach ($posts as $post)
                <li>
                    <strong>{{ $post->title }}</strong><br>
                    {{ $post->body }}

                    <!-- Bouton Like et compteur -->
                    @if (auth()->user()->hasLiked($post))
                        <form method="POST" action="{{ route('posts.unlike', $post->id) }}">
                            @csrf
                            <button type="submit">Unlike</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('posts.like', $post->id) }}">
                            @csrf
                            <button type="submit">Like</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
