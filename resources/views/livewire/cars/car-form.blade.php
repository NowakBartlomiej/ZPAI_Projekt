<div class="p-2">
    <form wire:submit.prevent='save'>
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                {{ "Edit Car" }}
            @else
                {{ "Create New Car" }}
            @endif
        </h3>

       
        
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="makeId">{{ "Make" }}</label>
            </div>
            <div>
                <select class="placeholder-secondary-400 text-secondary-800  dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm cursor-pointer overflow-hidden  selection:bg-transparent"  wire:model="makeId" id="makeId">
                    <option  value="">Select...</option>
                    @foreach ($makes as $make)
                        <option value="{{ $make->id }}">{{ $make->name }}</option>
                    @endforeach
                </select>
                {{-- ! Tu zmienic --}}
                {{-- <x-select placeholder="Select..."  :async-data="route('async.makes')" option-label="name" option-value="id" /> --}}
            </div>
        </div>

        <br>

        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="car_model_id">{{ "Model" }}</label>
            </div>
            <div>
                <select class="text-secondary-800 placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm cursor-pointer overflow-hidden  selection:bg-transparent" wire:model.defer="car.car_model_id" id="carModelId">
                    <option value="">Select...</option>
                    @foreach ($carModels as $carModel)
                        <option value="{{ $carModel->id }}">{{ $carModel->name }}</option>
                    @endforeach
                </select>
                {{-- !Tu zminic --}}
                {{-- <x-select placeholder="Select..." wire:model.defer='car.car_model_id' :async-data="route('async.carModels')" option-label="name" option-value="id" /> --}}
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="car_body_type_id">{{ "Body Type" }}</label>
            </div>
            <div>
                <x-select placeholder="Select..." wire:model.defer='car.body_type_id' :async-data="route('async.bodyTypes')" option-label="name" option-value="id" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="car_fuel_id">{{ "Fuel" }}</label>
            </div>
            <div>
                <x-select placeholder="Select..." wire:model.defer='car.fuel_id' :async-data="route('async.fuels')" option-label="name" option-value="id" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="year">{{ "Year" }}</label>
            </div>
            <div>
                <x-input placeholder="Year..." wire:model='car.year'></x-input>
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="odometer">{{ "Odometer" }}</label>
            </div>
            <div>
                <x-input placeholder="Odometer..." wire:model='car.odometer'></x-input>
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="VIN">{{ "VIN" }}</label>
            </div>
            <div>
                <x-input placeholder="VIN..." wire:model='car.VIN'></x-input>
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="engine">{{ "Engine" }}</label>
            </div>
            <div>
                <x-input placeholder="Engine..." wire:model='car.engine'></x-input>
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="power">{{ "Power [KM]" }}</label>
            </div>
            <div>
                <x-input placeholder="Power..." wire:model='car.power'></x-input>
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('cars.index') }}" class="mr-2" label="Back" />
            <x-button type="submit" primary label="Save" spinner />
        </div>
    </form>
</div>