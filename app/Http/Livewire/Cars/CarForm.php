<?php

namespace App\Http\Livewire\Cars;

use App\Models\Car;
use App\Models\Make;
use Livewire\Component;
use App\Models\CarModel;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CarForm extends Component {
    use Actions;
    use AuthorizesRequests;

    public Car $car;
    public Bool $editMode;

    // ?
    public $makes;
    public $makeId;
    public $carModels;
    public $carModelId;
    // ?

    public function rules() {
        return [
            'car.car_model_id' => [
                'required',
                'integer',
                'exists:car_models,id'
            ],
            'car.body_type_id' => [
                'required',
                'integer',
                'exists:body_types,id'
            ],
            'car.fuel_id' => [
                'required',
                'integer',
                'exists:fuels,id'
            ],
            'car.year' => [
                'required',
                'integer',
                'min:1950',
                'max:2022'
            ],
            'car.odometer' => [
                'required',
                'integer',
                'min:0',
                'max:1000000'
            ],
            'car.VIN' => [
                'required',
                'string',
                'min:17',
                'max:17',
                'unique:cars,VIN' .
                    ($this->editMode ? (',' . $this->car->id) : '')
            ],
            'car.engine' => [
                'required',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'car.power' => [
                'required',
                'integer',
                'min:1',
                'max:2000'
            ],
        ];
    }

    public function validationAttributes() {
        return [
            // 'Name' mozna zamienic na tłumaczenie
            'car_model_id' => Str::lower('Car Model'),
            'body_type_id' => Str::lower('Body Type'),
            'fuel_id' => Str::lower('Fuel'),
            'year' => 'year',
            'odometer' => 'odometer',
            'VIN' => 'VIN',
            'engine' => 'engine',
            'power' => 'power'
        ];
    }

    public function mount(Car $car, Bool $editMode) {
        // ?
        $this->makes = Make::orderby('name')->get();
        
        // ?

        $this->car = $car;
        $this->car->load(['fuel', 'bodyType', 'carModel']);
        $this->makeId = $this->car->carModel->make_id;
        $this->getCarModels();
        $this->editMode = $editMode;
    }

    public function render() {
        return view('livewire.cars.car-form');
    }

    public function updatedMakeId() {
        $this->getCarModels();
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    } 

    // ?
    public function getCarModels() {
        if ($this->makeId != '') {
            $this->carModels = CarModel::with('make')->where('make_id', $this->makeId)->get();
        } else {
            $this->carModels = [];
        }
    }
    // ?

    public function save() {
        if ($this->editMode) {
            $this->authorize('update', $this->car);
        } else {
            $this->authorize('create', Car::class);
        }

        $this->validate();

        $this->car->save();

        $this->notification()->success(
            $title = $this->editMode
                ? 'Updated Successfully'
                : 'Saved Successfully',
            $description = $this->editMode
                ? 'Updated ' . $this->car->make->name . ' ' . $this->car->carModel->name . ' Successfully'
                : 'Created ' . $this->car->make->name . ' ' . $this->car->carModel->name . ' Successfully',
        );

        $this->editMode = true;
        $this->car->load(['fuel', 'bodyType', 'carModel']);
    }
}
