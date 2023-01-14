<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advert extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    // public function user() {
    //     return $this->belongsTo(User::class);
    // }

    public function car() {
        return $this->belongsTo(Car::class);
    }

    // nie do witch
    public function carModel() {
        return $this->car->carModel();
    }

    // nie do witch
    public function make() {
        return $this->car->carModel->make();
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    // nie do witch
    public function county() {
        return $this->city->county();
    }
}
