<div class="p-2">
    <form wire:submit.prevent='save'>
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                {{ "Edit Car Model" }}
            @else
                {{ "Create New Car Model" }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="make_id">{{ "Make" }}</label>
            </div>
            <div>
                <x-select placeholder="Select..." wire:model.defer='carModel.make_id' :async-data="route('async.makes')" option-label="name" option-value="id" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ "Name" }}</label>
            </div>
            <div>
                <x-input placeholder="Car Model name..." wire:model='carModel.name'></x-input>
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('carModels.index') }}" class="mr-2" label="Back" />
            <x-button type="submit" primary label="Save" spinner />
        </div>
    </form>
</div>