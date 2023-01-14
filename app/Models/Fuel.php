<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fuel extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $fillable = [
    //     'name'
    // ];

    protected $guarded = [];

    public function cars() {
        return $this->hasMany(Car::class);
    }

}
