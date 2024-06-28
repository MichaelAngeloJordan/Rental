<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'driver_id',
        'pickup_time',
        'return_time',
        'pickup_address',
        'return_address',
        'status',
        'note',
        'total_price',
    ];

    protected function casts(): array
    {
        return [
            'pickup_time' => 'datetime',
            'return_time' => 'datetime',
            'total_price' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
