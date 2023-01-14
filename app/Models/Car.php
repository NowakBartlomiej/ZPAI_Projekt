<?php

namespace App\Models;

use App\Models\Fuel;
use App\Models\Make;
use App\Models\BodyType;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function fuel() {
        return $this->belongsTo(Fuel::class);
    }

    public function bodyType() {
        return $this->belongsTo(BodyType::class);
    }

    public function carModel() {
        return $this->belongsTo(CarModel::class);
    }

    public function make() {
        return $this->carModel->make();
    }

    public function adverts() {
        return $this->hasMany(Advert::class);
    }
}
