<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts of {{ $user->name }}</title>
</head>

<body>
    <h1 class="dark:text-slate-500">Posts of {{ $user->name }}</h1>

    @if ($posts->isEmpty())
    <p>No posts found for this user.</p>
    @else
    <div class="flex flex-wrap justify-center">
        @foreach ($posts as $post)
        <div class="relative m-20 p-2 dark:bg-slate-700 rounded-lg w-full md:w-1/2 lg:w-1/3 flex flex-col">
            <img src="{{ $post->image_url }}" alt="Image de {{ $post->title }}" class="w-full h-48 object-cover rounded-t-lg">
            <div class="flex flex-col justify-between flex-grow">
                <div class="p-2 flex flex-col justify-between flex-grow">
                    <div class="mt-auto">
                        <h2 class="text-lg font-bold dark:text-slate-50 italic">{{ $post->title }}</h2>
                        <p class="mt-2 dark:text-slate-50">{{ $post->body }}</p>
                    </div>
                </div>
                <div class="text-white">
                    <strong>Hashtags:</strong>
                    @if ($post->hashtags->isEmpty())
                    <p>No hashtags associated with this post.</p>
                    @else
                    <ul>
                        @foreach ($post->hashtags as $hashtag)
                        <li>#{{ $hashtag->name }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-white">Delete post</button>
                </form>
                <!-- Bouton Like et compteur -->
                <div class="flex items-center justify-end mt-2 p-4 dark:text-slate-50">
                    @if (auth()->user()->hasLiked($post))
                    <form method="POST" action="{{ route('posts.unlike', $post->id) }}">
                        @csrf
                        <button type="submit" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart">
                                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                            </svg>
                            <span class="ml-1">{{ count($post->likes) }}</span>
                        </button>
                    </form>
                    @else
                    <form method="POST" action="{{ route('posts.like', $post->id) }}">
                        @csrf
                        <button type="submit" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart">
                                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                            </svg>
                            <span class="ml-1">{{ count($post->likes) }}</span>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</body>

</html>