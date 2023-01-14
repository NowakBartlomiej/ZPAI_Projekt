<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Fuels" }}
            {{-- TODO zrobic tłumaczenie --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="table-view-wrapper" class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid justify-items-stretch pt-2 pr-2">
                    <x-button primary label="Create Fuel" href="{{ route('fuels.create') }}" class="justify-self-end"/>
                </div>
                <livewire:fuels.fuels-table-view />
            </div>
        </div>
    </div>

</x-app-layout>