<?php

namespace App\Http\Livewire\Adverts;

use App\Models\Car;
use App\Models\Make;
use App\Models\Advert;
use Livewire\Component;
use App\Models\CarModel;
use App\Models\City;
use App\Models\County;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdvertForm extends Component{
    use Actions;
    use AuthorizesRequests;
    
    // Auto
    public Car $car;
    public $makes;
    public $makeId;
    public $carModels;
    public $carModelId;

    //

    // City 
    public City $city;
    public $counties;
    public $countyId;
    public $cities;
    public $cityId;
    // 

    public Advert $advert;
    public Bool $editMode;

    public function rules() {
        return [
            // Auto poczatek
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
            // Auto koniec

            'advert.car_id' => [
                'required',
                'integer',
                'exists:cities,id'
            ],
            'advert.price' => [
                'required',
                'integer',
                'min:0',
            ],
            'advert.description' => [
                'required',
                'string'
            ],
            'advert.city_id' => [
                'required',
                'integer',
                'exists:cities,id'
            ],
        ];
    }

    public function validationAttributes() {
        return [
            // Auto poczatek
            'car_model_id' => Str::lower('Car Model'),
            'body_type_id' => Str::lower('Body Type'),
            'fuel_id' => Str::lower('Fuel'),
            'year' => 'year',
            'odometer' => 'odometer',
            'VIN' => 'VIN',
            'engine' => 'engine',
            'power' => 'power',
            // Auto koniec
            
            'price' => 'price',
            'description' => 'description',
            'city_id' => 'city',
        ];
    }

    public function mount(Advert $advert, Car $car, City $city, Bool $editMode) {
        // Auto poczatek
        $this->makes = Make::orderby('name')->get();
        $this->getCarModels();

        $this->car = $car;
        $this->car->load(['fuel', 'bodyType', 'carModel']);
        $this->editMode = $editMode;
        // Auto koniec

        // City poczatek
        $this->counties = County::orderby('name')->get();
        $this->getCities();

        // City koniec
        
        $this->advert = $advert;
        $this->advert->load(['car', 'city']);
        $this->editMode = $editMode;
    }

    public function updatedMakeId() {
        $this->getCarModels();
    }

    public function updatedCountyId() {
        $this->getCities();
    }

    public function render() {
        return view('livewire.adverts.advert-form');
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    } 

    // Auto poczatek
    public function getCarModels() {
        if ($this->makeId != '') {
            $this->carModels = CarModel::with('make')->where('make_id', $this->makeId)->get();
        } else {
            $this->carModels = [];
        }
    }
    // Auto koniec

    // City poczatek
    public function getCities() {
        if ($this->countyId != '') {
            $this->cities = City::with('county')->where('county_id', $this->countyId)->orderBy('name')->get();
        } else {
            $this->cities = [];
        }
    }
    // City koniec

    public function save() {
        // if ($this->editMode) {
        //     $this->authorize('update', $this->car);
        //     $this->authorize('update', $this->advert);
        // } //else {
        //     $this->authorize('create', Car::class);
        //     $this->authorize('create', Advert::class);
        // }
        // !Poprawic editMode

        $this->validate();

        DB::transaction(function() {
            $car = $this->car;
            $carVIN = $car->VIN;
            $advert = $this->advert;

            // Zapisywanie auta
            $car->save();

            $createdCarId = DB::table('cars')->where('VIN', '=', $carVIN)->value('id');

            $advert->car_id = $createdCarId;

            // Zapisywanie ogloszenia
            $advert->save();

            // dd( $car, $carVIN, $advert);
        });

        
        // Stara metoda
        // $car = $this->car;
        // $advert = $this->advert;

        // $this->advert->save();
        // DB::transaction(function() use ($car, $advert) {
        //     dd($advert, $car);
        //     $car->save();
        //     $carId = $car->id;
    
        //     $advert->car_id = $carId;
        //     $advert->save();
            
        // });

        $this->notification()->success(
            $title = $this->editMode
                ? 'Updated Successfully'
                : 'Saved Successfully',
            $description = $this->editMode
                ? 'Updated Advert: ' . $this->advert->id . ' Successfully'
                : 'Created Advert: ' . $this->advert->id .  ' Successfully',
        );

        $this->editMode = true;
        $this->advert->load(['car', 'city']);
    }
}
