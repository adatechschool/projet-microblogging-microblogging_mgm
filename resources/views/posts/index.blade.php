<x-app-layout>
    <h1 class="text-3xl dark:bg-slate-900 dark:text-slate-50 font-bold flex items-center justify-center pt-6 pb-14 underline">Tous les posts disponibles</h1>
    <div class="flex flex-wrap justify-center">
        @foreach($posts as $post)
            <div class="m-20 p-2 dark:bg-slate-700 rounded-lg w-full md:w-1/2 lg:w-1/3"> 
                <!-- photo -->
                <img src="{{ $post->image_url }}" alt="Image de {{ $post->title }}" class="w-full h-48 object-cover rounded-t-lg">

                <div class="p-4">
                    <h2 class="text-mg font-bold dark:text-slate-50">{{ $post->title }}</h2>
                    <a href="{{ url('/posts', $post->id) }}" class=" dark:text-slate-300">Voir le post</a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
