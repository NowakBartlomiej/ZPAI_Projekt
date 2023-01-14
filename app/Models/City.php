<?php

namespace App\Models;

use App\Models\County;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function county() {
        return $this->belongsTo(County::class);
    }

    public function adverts() {
        return $this->hasMany(Advert::class);
    }
}
