<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information -->
            <div class="p-4 sm:p-8 dark:bg-slate-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-4 sm:p-8 bg-white dark:bg-slate-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User -->
            <div class="p-4 sm:p-8 dark:bg-slate-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Update Hashtags -->
            <div class="p-4 sm:p-8 bg-white dark:bg-slate-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('users.update-hashtags', auth()->id()) }}">
                        @csrf
                        <label for="hashtags" class="dark:text-slate-50">Your Hashtags (comma-separated):</label>
                        <input class="dark:border-grey-900 rounded-md dark:bg-slate-900 flex flex-col " type="text" name="hashtags" id="hashtags" value="{{ $user->hashtags->pluck('name')->implode(', ') }}" class="block mt-1 w-full">

                        <button type="submit" class="mt-4 dark:bg-slate-50 dark:text-slate-950 py-2 px-4 rounded">Update Hashtags</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
