<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'car_id',
        'available_from',
        'available_until',
    ];

    protected function casts(): array
    {
        return [
            'available_from' => 'datetime',
            'available_until' => 'datetime',
        ];
    }

    /**
     * Get the location that owns the car location.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the car that owns the car location.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
