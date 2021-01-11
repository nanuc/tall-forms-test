@php(Auth::login(\App\Models\User::first()))
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-card heading="Classic TALL form">
        <livewire:forms.classic-tall-form :user="\App\Models\User::find(1)"/>
    </x-card>

    <x-card heading="TALL form with resource">
        <livewire:forms.tall-form-with-resource :user="\App\Models\User::find(2)"/>
    </x-card>

    <x-card heading="TALL form with same resource, but less fields and in other order">
        <livewire:forms.tall-form-with-same-resource :user="\App\Models\User::find(2)"/>
    </x-card>

    <x-card heading="Table (for now with MedicOneSystems) for same resource">
        <livewire:forms.demo-table />
    </x-card>

    <x-card heading="Table with same resource but less fields and other column order">
        <livewire:forms.demo-table-little />
    </x-card>
</x-app-layout>
