<div class="p-2">
    <form wire:submit.prevent='save'>
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                {{ "Edit Make" }}
            @else
                {{ "Create New Make" }}
            @endif
        </h3>

        <hr class="my-2">

        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ "Name" }}</label>
            </div>
            <div>
                <x-input placeholder="Make name..." wire:model='make.name'></x-input>
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('makes.index') }}" class="mr-2" label="Back" />
            <x-button type="submit" primary label="Save" spinner />
        </div>
    </form>
</div>