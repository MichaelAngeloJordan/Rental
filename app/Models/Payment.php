<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_method',
        'payment_number',
        'payment_name',
        'payment_bank',
        'status',
        'total_payment',
        'due_date',
        'note',
        'attachment',
        'is_verified',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
            'total_payment' => 'integer',
        ];
    }
}
