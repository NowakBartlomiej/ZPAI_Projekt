<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class County extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'code'
    ];

    public function cities() {
        return $this->hasMany(City::class);
    }
}
