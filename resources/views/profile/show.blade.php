<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl dark:text-red-800 leading-tight text-center">
            {{ __('Profile') }}
        </h2>
        <!-- Display User Hashtags -->
        <div class="mt-2 text-center">
            @if($hashtags->isNotEmpty())
                <p class="text-lg font-semibold">Mes Préférences :</p>
                <div class="mt-2">
                    @foreach($hashtags as $hashtag)
                        <span class="inline-block bg-red-200 dark:bg-red-800 text-sm font-medium mr-2 mb-2 px-2.5 py-0.5 rounded">{{ $hashtag->name }}</span>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">You have no hashtags associated with your profile.</p>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-wrap justify-center space-x-4">

                <!-- Mes Préférences -->
                <div class="flex-1 dark:bg-slate-700 shadow sm:rounded-lg p-4 text-center">
                    <h3 class="text-lg font-medium dark:text-slate-50">{{ __('Mes Préférences') }}</h3>
                    <div>
                        @foreach($hashtags as $hashtag)
                            <span class="inline-block dark:bg-slate-800 text-sm font-medium mr-2 mb-2 px-2 py-1 rounded">{{ $hashtag->name }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- Posts Likés -->
                <div class="flex-1 dark:bg-slate-700 shadow sm:rounded-lg p-4 text-center">
                    <h3 class="text-lg font-medium dark:text-slate-50">{{ __('Posts Likés') }}</h3>
                    @foreach($likedPosts as $post)
                        <div class="mt-2 bg-slate-100 dark:bg-slate-800 rounded-lg shadow-md p-4">
                            <h4 class="text-md font-semibold dark:text-slate-50">{{ $post->title }}</h4>
                            <p class="text-sm">{{ $post->content }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Abonnements -->
                <div class="flex-1 dark:bg-slate-700 shadow sm:rounded-lg p-4 text-center">
                    <h3 class="text-lg font-medium dark:text-slate-50">{{ __('Abonnements') }}</h3>
                    <div>
                        {{ $followingCount }}
                    </div>
                </div>
            </div>

            <!-- Carte "Mes posts" -->
            <div class="bg-slate-50 dark:bg-slate-700 shadow sm:rounded-lg p-4 max-w-sm mx-auto">
                <h3 class="text-xl font-medium dark:text-slate-50 text-center mb-4">{{ __('Posts') }}</h3>
            </div>
            
        </div>
    </div>

    <!-- Mes posts -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-20 ml-20 mr-20 pb-8">
        @foreach($myPosts as $myPost)
        <div class="p-6 rounded-lg dark:bg-slate-700 dark:text-slate-50 ">
            <h4 class="text-lg font-bold mb-2">{{ $myPost->title }}</h4>
            @if ($myPost->body)
                <p class="text-sm dark:text-slate-50">{{ $myPost->body }}</p>
            @endif
            @if ($myPost->photo)
                <img src="{{ asset('uploads/' . $myPost->photo) }}" alt="Post Image" class="mt-4 rounded-md >
            @endif
            @if($myPost->hashtags)
                <div class="mt-4">
                    <p class="text-sm font-bold">Mes Préférences :</p>
                    <div class="mt-2">
                        @foreach($myPost->hashtags as $hashtag)
                            <span class="inline-block dark:bg-slate-800 text-sm font-medium mr-2 mb-2 px-2 py-1 rounded">{{ $hashtag->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
            @if (auth()->user()->id == $myPost->user_id)
                <form method="POST" action="{{route('posts.destroy', $myPost->id)}}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class=" dark:bg-slate-50 dark:text-slate-700 rounded font-bold p-1">Delete post</button>
                </form>
            @endif
        </div>
        @endforeach
    </div>
</x-app-layout>
