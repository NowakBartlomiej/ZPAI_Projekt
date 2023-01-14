<?php

namespace App\Http\Livewire\Makes;

use App\Models\Make;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class MakeForm extends Component {
    use Actions;
    use AuthorizesRequests;

    public Make $make;
    public Bool $editMode;

    public function rules() {
        return [
            'make.name' => [
                'required',
                'string',
                'min:2',
                'unique:makes,name' . 
                    ($this->editMode ? (',' . $this->make->id) : ''),
            ],
        ];
    }

    public function validationAttributes() {
        return [
            // 'Name' mozna zamienic na tłumaczenie
            'name' => Str::lower('Name')
        ];
    }

    public function mount(Make $make, Bool $editMode) {
        $this->make = $make;
        $this->editMode = $editMode;
    }

    public function render() {
        return view('livewire.makes.make-form');
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function save() {
        if ($this->editMode) {
            $this->authorize('update', $this->make);
        } else {
            $this->authorize('create', Make::class);
        }

        sleep(1);
        $this->validate();
        $this->make->save();
        $this->notification()->success(
            $title = $this->editMode
                ? 'Updated Successfully'
                : 'Saved Successfully',
            $description = $this->editMode
                ? 'Updated ' . $this->make->name . ' Successfully'
                : 'Created ' . $this->make->name . ' Successfully',
        );
        $this->editMode = true;
    }
}
