

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl flex justify-center items-center dark:text-slate-50 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen py-12 dark:bg-slate-900">
        <div class="dark:bg-slate-700 shadow-lg rounded-lg overflow-hidden flex items-center justify-center" style="width: 300px; height: 300px;">
            <div class="flex flex-col items-center justify-center h-full p-6 dark:text-slate-50">
                <div class="text-center">
                    <div class="font-bold text-xl mb-4">
                        {{ __("You're logged in!") }}
                    </div>
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-check">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                        <polyline points="16 11 18 13 22 9"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
