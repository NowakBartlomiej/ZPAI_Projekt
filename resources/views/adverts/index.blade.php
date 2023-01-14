<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Adverts" }}
            {{-- TODO zrobic tłumaczenie --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="table-view-wrapper" class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-5 py-3">
                <div class="grid justify-items-stretch pt-2 pr-2">
                    @can('create', App\Models\Advert::class)
                        <x-button primary label="Create Advert" href="{{ route('adverts.create') }}" class="justify-self-end"/>
                    @endcan
                </div>
                <livewire:adverts.adverts-grid-view />
            </div>
        </div>
    </div>

</x-app-layout>