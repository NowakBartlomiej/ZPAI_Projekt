<?php

namespace App\Http\Livewire\Cities;

use App\Models\City;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CityForm extends Component {
    use Actions;
    use AuthorizesRequests;

    public City $city;
    public Bool $editMode;

    public function rules() {
        return [
            'city.name' => [
            'required',
            'string',
            'min:2',
            'max:100',
            'unique:cities,name' . 
                ($this->editMode ? (',' . $this->city->id) : '')
            ],
            'city.county_id' => [
                'required',
                'integer',
                'exists:counties,id'
            ],
        ];
    }

    public function validationAttributes() {
        return [
            // 'Name' mozna zamienic na tłumaczenie
            'county_id' => Str::lower('County'),
            'name' => Str::lower('Name'),
        ];
    }

    public function mount(City $city, Bool $editMode) {
        $this->city = $city;
        $this->city->load('county');
        $this->editMode = $editMode;
    }

    public function render() {
        return view('livewire.cities.city-form');
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function save() {
        if ($this->editMode) {
            $this->authorize('update', $this->city);
        } else {
            $this->authorize('create', City::class);
        }

        $this->validate();

        $this->city->save();

        $this->notification()->success(
            $title = $this->editMode
                ? 'Updated Successfully'
                : 'Saved Successfully',
            $description = $this->editMode
                ? 'Updated ' . $this->city->name . ' Successfully'
                : 'Created ' . $this->city->name . ' Successfully',
        );

        $this->editMode = true;
        $this->city->load('county');
    }
}
