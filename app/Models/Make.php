<?php

namespace App\Models;

use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Make extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function carModels() {
        return $this->hasMany(CarModel::class);
    }

    
}
