<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Make;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function make() {
        return $this->belongsTo(Make::class);
    }

    public function cars() {
        return $this->hasMany(Car::class);
    }
}
