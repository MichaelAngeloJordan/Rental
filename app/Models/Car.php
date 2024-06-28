<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'type',
        'color',
        'capacity',
        'baggages',
        'license_plate',
        'transmission',
        'year',
        'price',
        'image',
        'description',
        'features',
        'policy',
        'available',
    ];

    protected $appends = ['image_url'];

    protected $casts = [
        'available' => 'boolean',
    ];

    public function brand()
    {
        return $this->belongsTo(BrandCar::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'cars_locations');
    }

    /**
     * Get Car Image
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/car.png');
    }
}
