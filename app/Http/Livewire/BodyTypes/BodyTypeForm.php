<?php

namespace App\Http\Livewire\BodyTypes;

use Livewire\Component;
use App\Models\BodyType;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BodyTypeForm extends Component {
    use Actions;
    use AuthorizesRequests;

    public BodyType $bodyType;
    public Bool $editMode;

    // Reguly walidacji
    public function rules() {
        return [
            'bodyType.name' => [
                'required',
                'string',
                'min:2',
                'unique:body_types,name' . 
                    ($this->editMode ? (',' . $this->bodyType->id) : ''),
            ],
        ];
    }

    public function validationAttributes() {
        return [
            // 'Name' mozna zamienic na tłumaczenie
            'name' => Str::lower('Name')
        ];
    }

    public function mount(BodyType $bodyType, Bool $editMode) {
        $this->bodyType = $bodyType;
        $this->editMode = $editMode;
    }

    public function render() {
        return view('livewire.bodyTypes.bodyType-form');
    }

    // Walidacja na zywo
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function save() {
        sleep(1);
        $this->validate();
        $this->bodyType->save();
        $this->notification()->success(
            $title = $this->editMode
                ? 'Updated Successfully'
                : 'Saved Successfully',
            $description = $this->editMode
                ? 'Updated ' . $this->bodyType->name . ' Successfully'
                : 'Created ' . $this->bodyType->name . ' Successfully',
        );
        $this->editMode = true;
    }
}
