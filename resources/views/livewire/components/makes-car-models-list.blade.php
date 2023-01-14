<div>
    <label for="makeId">Make: </label>
    <select wire:model="makeId" id="makeId">
        <option value="">Select...</option>
        @foreach ($makes as $make)
            <option value="{{ $make->id }}">{{ $make->name }}</option>
        @endforeach
    </select>

    <label for="carModelId">Model: </label>
    <select wire:model="carModelId" id="carModelId">
        <option value="">Select...</option>
        @foreach ($carModels as $carModel)
            <option value="{{ $carModel->id }}">{{ $carModel->name }}</option>
        @endforeach
    </select>
</div>
