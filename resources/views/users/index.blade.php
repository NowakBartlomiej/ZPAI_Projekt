<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ "Users" }}
        {{-- TODO zrobic tłumaczenie --}}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div id="table-view-wrapper" class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <livewire:users.users-table-view />
        </div>
    </div>
</div>
</x-app-layout>

{{-- 
    <ul>
        @foreach ($users as $user)
            <li>
                {{ $user->name }}
                    @if ($user->roles->count() > 0)
                        [
                            @foreach ($user->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        ]
                @endif
            </li>
        @endforeach
    </ul>
--}}