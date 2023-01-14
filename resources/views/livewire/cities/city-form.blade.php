<div class="p-2">
    <form wire:submit.prevent='save'>
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                {{ "Edit City" }}
            @else
                {{ "Create New City" }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="county_id">{{ "County" }}</label>
            </div>
            <div>
                <x-select placeholder="Select..." wire:model.defer='city.county_id' :async-data="route('async.counties')" option-label="name" option-value="id" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ "Name" }}</label>
            </div>
            <div>
                <x-input placeholder="City name..." wire:model='city.name'></x-input>
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('cities.index') }}" class="mr-2" label="Back" />
            <x-button type="submit" primary label="Save" spinner />
        </div>
    </form>
</div>