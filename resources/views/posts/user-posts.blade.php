<x-app-layout>
    <p class="text-center text-white flex justify-center space-x-4 m-6">
        <span class="border border-slate-300 rounded-lg px-3 py-1">Publications : {{ $user->posts()->count() }}</span>
        <span class="border border-slate-300 rounded-lg px-3 py-1">Abonnés : {{ $user->followers()->count() }}</span>
        <span class="border border-slate-300 rounded-lg px-3 py-1">Abonnements : {{ $user->following()->count() }}</span>
    </p>
    <p class="text-center text-white flex justify-center space-x-4 m-6">
     <span class="border border-slate-300 rounded-lg px-3 py-1">
            Préférences :
            <span class="text-slate-50">
                @foreach($user->hashtags as $hashtag)
                    {{ $loop->first ? '' : ', ' }}{{ $hashtag->name }}
                @endforeach
            </span>
        </span>
    </p>
    <h1 class="text-3xl dark:bg-slate-900 dark:text-slate-50 font-bold flex items-center justify-center pt-6 pb-14 underline">Les posts de {{ $user->name }}</h1>
    @if (Auth::check() && Auth::user()->id !== $user->id)
        @if (Auth::user()->following()->where('followed_id', $user->id)->exists())
            <!-- Bouton se désabonner -->
            <form action="{{ route('unfollow', $user->id) }}" method="POST">
                @csrf
                <div class="flex justify-center mb-4">
                    <button type="submit" class="border-solid border-2 border-slate-50 justify-center w-auto p-2 bg-slate-700 text-slate-50 py-2 rounded shadow hover:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900">Unfollow</button>
                    </div>
            </form>
        @else
            <!-- Bouton s'abonner -->
            <form action="{{ route('follow', $user->id) }}" method="POST">
                @csrf
                <div class="flex justify-center mb-4">
                    <button type="submit" class="border-solid border-2 border-slate-50 justify-center w-auto p-2 bg-slate-700 text-slate-50 py-2 rounded shadow hover:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900">Follow</button>
                </div>
            </form>
        @endif
    @endif
    @if ($posts->isEmpty())
    <p class="text-center text-white">No posts found for this user.</p>
    @else
    <div class="flex flex-wrap justify-center">
        @foreach ($posts as $post)
        <div class="relative m-20 p-2 dark:bg-slate-700 rounded-lg w-full md:w-1/2 lg:w-1/3 flex flex-col">
            <img src="{{ asset('uploads/' . $post->photo) }}" alt="Image de {{ $post->title }}" class="w-full h-48 object-cover rounded-t-lg">
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
                @csrf
                @method('DELETE')
            
            @if (auth()->user()->id == $user->id)
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-slate-50 text-slate-800 font-bold p-1 rounded ">Delete post</button>
                </form>
            @endif
            <!-- Bouton Like et compteur -->
            <div class="flex items-center justify-end mt-2 p-4 dark:text-slate-50">
                @if (auth()->user()->hasLiked($post))
                <form method="POST" action="{{ route('posts.unlike', $post->id) }}">
                    @csrf
                    <button type="submit" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                        </svg>
                        <span class="ml-1">{{ count($post->likes) }}</span>
                    </button>
                </form>
                @else
                <form method="POST" action="{{ route('posts.like', $post->id) }}">
                    @csrf
                    <button type="submit" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
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
</x-app-layout>