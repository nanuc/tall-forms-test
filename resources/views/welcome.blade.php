@php(Auth::login(\App\Models\User::first()))
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-card>
        <livewire:forms.user-form />
    </x-card>

    <x-card>
        <livewire:forms.user-form />
    </x-card>
</x-app-layout>
