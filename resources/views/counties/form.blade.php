<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "County" }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                @if (isset($county))
                    <livewire:counties.county-form :county="$county" :editMode="true">
                @else
                <livewire:counties.county-form :editMode="false">
                @endif
            </div>
        </div>
    </div>        
</x-app-layout>