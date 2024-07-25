<!DOCTYPE html>
<html>
<head>
    <title>All Posts</title>
</head>
<body>
    <h1>All Posts</h1>

    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ url('/posts', $post->id) }}">{{ $post->title }}</a> 
                {{-- by {{ $post->user->name }} --}}
            </li>
        @endforeach
    </ul>
</body>
</html>
