<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Car" }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                @if (isset($car))
                    <livewire:cars.car-form :car="$car" :editMode="true" />
                @else
                    <livewire:cars.car-form :editMode="false" />
                @endif
            </div>
        </div>
    </div>        
</x-app-layout>