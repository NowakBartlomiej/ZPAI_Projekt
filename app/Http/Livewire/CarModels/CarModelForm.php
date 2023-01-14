<?php

namespace App\Http\Livewire\CarModels;

use Livewire\Component;
use App\Models\CarModel;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CarModelForm extends Component{
    use Actions;
    use AuthorizesRequests;

    public CarModel $carModel;
    public Bool $editMode;

    public function rules() {
        return [
            'carModel.name' => [
            'required',
            'string',
            'min:1',
            'max:100',
            'unique:car_models,name' . 
                ($this->editMode ? (',' . $this->carModel->id) : '')
            ],
            'carModel.make_id' => [
                'required',
                'integer',
                'exists:makes,id'
            ],
        ];
    }

    public function validationAttributes() {
        return [
            // 'Name' mozna zamienic na tłumaczenie
            'make_id' => Str::lower('Make'),
            'name' => Str::lower('Name'),
        ];
    }

    public function mount(CarModel $carModel, Bool $editMode) {
        $this->carModel = $carModel;
        $this->carModel->load('make');
        $this->editMode = $editMode;
    }

    public function render() {
        return view('livewire.carModels.carModel-form');
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    } 

    public function save() {
        if ($this->editMode) {
            $this->authorize('update', $this->carModel);
        } else {
            $this->authorize('create', CarModel::class);
        }
        $this->validate();

        $this->carModel->save();

        // $makeId = $this->carModel->make;
        // unset($this->carModel->make);

        // $carModel = $this->carModel;
        // DB::transaction(function () use ($carModel, $makeId) {
        //     $carModel->save();
        //     $carModel->make()->sync($makeId);
        // });

        $this->notification()->success(
            $title = $this->editMode
                ? 'Updated Successfully'
                : 'Saved Successfully',
            $description = $this->editMode
                ? 'Updated ' . $this->carModel->name . ' Successfully'
                : 'Created ' . $this->carModel->name . ' Successfully',
        );

        $this->editMode = true;
        $this->carModel->load('make');
    }

}
