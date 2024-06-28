<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
        'status',
        'license_number',
        'license_image',
    ];

    protected $appends = [
        'license_image_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the license image path.
     *
     * @param  string  $value
     * @return string
     */
    public function getLicenseImagePathAttribute()
    {
        return asset('storage/' . $this->license_image);
    }
}
