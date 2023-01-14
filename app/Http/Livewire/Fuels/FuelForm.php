<?php

namespace App\Http\Livewire\Fuels;

use App\Models\Fuel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class FuelForm extends Component {
    use Actions;
    use AuthorizesRequests;

    public Fuel $fuel;
    public Bool $editMode;

    // Reguly walidacji
    public function rules() {
        return [
            'fuel.name' => [
                'required',
                'string',
                'min:2',
                'unique:makes,name' . 
                    ($this->editMode ? (',' . $this->fuel->id) : ''),
            ],
        ];
    }

    public function validationAttributes() {
        return [
            // 'Name' mozna zamienic na tłumaczenie
            'name' => Str::lower('Name')
        ];
    }

    public function mount(Fuel $fuel, Bool $editMode) {
        $this->fuel = $fuel;
        $this->editMode = $editMode;
    }

    public function render() {
        return view('livewire.fuels.fuel-form');
    }

    // Walidacja na zywo
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function save() {
        sleep(1);
        $this->validate();
        $this->fuel->save();
        $this->notification()->success(
            $title = $this->editMode
                ? 'Updated Successfully'
                : 'Saved Successfully',
            $description = $this->editMode
                ? 'Updated ' . $this->fuel->name . ' Successfully'
                : 'Created ' . $this->fuel->name . ' Successfully',
        );
        $this->editMode = true;
    }
}
