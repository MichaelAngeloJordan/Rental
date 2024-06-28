<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'province',
        'zip_code',
        'latitude',
        'longitude',
    ];

    public function cars()
    {
        return $this->hasMany(CarLocation::class);
    }
}
