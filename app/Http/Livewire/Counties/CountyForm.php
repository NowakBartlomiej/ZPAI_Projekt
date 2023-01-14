<?php

namespace App\Http\Livewire\Counties;

use App\Models\County;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CountyForm extends Component {
    use Actions;
    use AuthorizesRequests;

    public County $county;
    public Bool $editMode;

    // Reguly walidacji
    public function rules() {
        return [
            'county.name' => [
                'required',
                'string',
                'min:2',
                'unique:counties,name' . 
                    ($this->editMode ? (',' . $this->county->id) : ''),
            ],
            'county.code' => [
                'required',
                'string',
                'max:2',
                'unique:counties,code' . 
                    ($this->editMode ? (',' . $this->county->id) : ''),
            ],
        ];
    }

    public function validationAttributes() {
        return [
            // 'Name' mozna zamienic na tłumaczenie
            'name' => Str::lower('Name')
        ];
    }

    public function mount(County $county, Bool $editMode) {
        $this->county = $county;
        $this->editMode = $editMode;
    }

    public function render() {
        return view('livewire.counties.county-form');
    }

    // Walidacja na zywo
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function save() {
        sleep(1);
        $this->validate();
        $this->county->save();
        $this->notification()->success(
            $title = $this->editMode
                ? 'Updated Successfully'
                : 'Saved Successfully',
            $description = $this->editMode
                ? 'Updated ' . $this->county->name . ' Successfully'
                : 'Created ' . $this->county->name . ' Successfully',
        );
        $this->editMode = true;
    }
}
