<x-app-layout>
    <div class="flex items-center justify-center h-screen dark:bg-slate-900">
        <div class="w-2/3 h-2/3 dark:bg-slate-700 shadow-md rounded-lg overflow-hidden">
            <div class="p-6 flex flex-col h-full">
                <p>{{ $post->user->name}}</p>
                
{{-- 
                <p>{{ $post->hashtags }}</p>
                <p>{{ $post->likes }}</p> --}}
               
                <!-- photo -->
                <div class="flex-grow mb-4">
                    <img src="chemin/vers/votre-photo.jpg" alt="Photo" class="w-full h-auto object-cover rounded-lg">
                </div>
                
                <h1 class="text-lg italic dark:text-slate-50 font-semibold mb-4">{{ $post->title }}</h1>
                
                <p class="dark:text-slate-50">{{ $post->body }}</p>

            </div>
        </div>
    </div>
</x-app-layout>
