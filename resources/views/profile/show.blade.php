<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
         <!-- Display User Hashtags -->
         <div class="mt-2">
            @if($hashtags->isNotEmpty())
                <p class="text-lg font-semibold">Mes Préférences :</p>
                <div class="mt-2">
                    @foreach($hashtags as $hashtag)
                        <span class="inline-block bg-blue-200 text-blue-800 text-sm font-medium mr-2 mb-2 px-2.5 py-0.5 rounded">{{ $hashtag->name }}</span>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">You have no hashtags associated with your profile.</p>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Posts Likés') }}</h3>
                @foreach($likedPosts as $post)
                    <div class="mt-2">
                        <h4 class="text-md font-semibold">{{ $post->title }}</h4>
                        <p class="text-sm">{{ $post->content }}</p>
                    </div>
                @endforeach
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Abonnements') }}</h3>
                @foreach($following as $followedUser)
                    <div class="mt-2">
                        <p class="text-sm">{{ $followedUser->name }}</p>
                    </div>
                @endforeach
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Préférences') }}</h3>
                @foreach($preferences as $preference)
                    <p class="text-sm">#{{ $preference->name }}</p>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
