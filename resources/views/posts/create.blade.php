<x-app-layout>
    <!-- Titre de la page -->
    <h1 class="flex justify-center m-10 text-3xl font-bold text-gray-900 dark:text-slate-50 mb-6">Create a New Post</h1>
<h1 class="flex justify-center dark:text-slate-50"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-pen"><path d="M2 21a8 8 0 0 1 10.821-7.487"/><path d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/><circle cx="10" cy="8" r="5"/></svg>
</h1>
     <!-- Formulaire -->
   <div class="flex justify-center m-20 dark:bg-slate-900">
       <div class="w-full max-w-lg bg-white dark:bg-slate-700 shadow-md rounded-lg overflow-hidden">
           <div class="p-6 flex flex-col">
               <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                   @csrf
                   <div class="mb-4">
                       <label for="title" class="block text-gray-700 dark:text-slate-300 text-sm font-semibold">Title</label>
                       <input type="text" id="title" name="title" class="form-control mt-1 block w-full border-gray-300 dark:border-slate-500 rounded-md shadow-sm" required>
                   </div>
                   <div class="mb-4">
                       <label for="body" class="block text-gray-700 dark:text-slate-300 text-sm font-semibold">Body</label>
                       <textarea id="body" name="body" class="form-control mt-1 block w-full border-gray-300 dark:border-slate-500 rounded-md shadow-sm"></textarea>
                   </div>
                   <div class="mb-4">
                       <label for="photo" class="block text-gray-700 dark:text-slate-300 text-sm font-semibold">Photo</label>
                       <input type="file" id="photo" name="photo" class="form-control mt-1 block w-full border-gray-300 dark:border-slate-500 rounded shadow-sm">
                   </div>
                   <div class="mb-4">
                       <label for="hashtags" class="block text-gray-700 dark:text-slate-300 text-sm font-semibold">Hashtags (comma separated)</label>
                       <input type="text" id="hashtags" name="hashtags" class="form-control mt-1 block w-full border-gray-300 dark:border-slate-500 rounded shadow-sm">
                   </div>
                   <div class="flex justify-center mb-4">
                   <button type="submit" class="w-1/3 bg-slate-900 text-slate-50 py-2 rounded shadow hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-900">Submit</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
</x-app-layout>



{{-- <form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <textarea id="body" name="body" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" id="photo" name="photo" class="form-control">
    </div>

    <div class="form-group">
        <label for="hashtags">Hashtags (comma separated)</label>
        <input type="text" id="hashtags" name="hashtags" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form> --}}