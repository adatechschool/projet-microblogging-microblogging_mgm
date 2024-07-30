<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl flex justify-center items-center dark:text-slate-50 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen py-12 dark:bg-slate-900">
        <div class="dark:bg-slate-700 shadow-lg rounded-lg overflow-hidden" style="width: 300px; height: 300px;">
            <div class="flex items-center justify-center h-full p-6 dark:text-slate-50">
                <div class="text-center">
                    <div class="font-bold text-xl">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
