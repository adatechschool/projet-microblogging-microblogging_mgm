<x-app-layout>
    <h1 class="text-white flex justify-center items-center text-2xl m-4">Les posts de {{ $user->name }}</h1>

    @if ($posts->isEmpty())
    <p>No posts found for this user.</p>
    @else
    <div class="">
        @foreach ($posts as $post)
        <div class="flex flex-col bg-white m-2 rounded-sm">
            <strong>{{ $post->title }}</strong><br>

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
            <p class="">{{ $post->body }}</p>
            <p>Nombre de like:{{ count($post->likes) }}</p>
        </div>
        @endforeach
    </div>
    @endif
</x-app-layout>