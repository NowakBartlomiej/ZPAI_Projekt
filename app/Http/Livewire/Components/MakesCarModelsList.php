<?php

namespace App\Http\Livewire\Components;

use App\Models\CarModel;
use App\Models\Make;
use Livewire\Component;

class MakesCarModelsList extends Component
{
    public $makes;
    public $makeId;
    public $carModels;
    public $carModelId;
    
    public function mount() {
        $this->makes = Make::orderby('name')->get();

        $this->getCarModels();
    }

    public function updatedMakeId() {
        $this->getCarModels();
    }

    public function getCarModels() {
        if ($this->makeId != '') {
            $this->carModels = CarModel::with('make')->where('make_id', $this->makeId)->get();
        } else {
            $this->carModels = [];
        }
    }
    
    public function render()
    {
        return view('livewire.components.makes-car-models-list');
    }
}
