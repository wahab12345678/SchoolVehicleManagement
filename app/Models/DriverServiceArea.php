<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverServiceArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'area_name',
        'city',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The driver associated with this service area.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    /**
     * The user record associated with this service area (driver is a user).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    /**
     * Scope query to only include active service areas.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope query to filter by area name (case-insensitive substring or match).
     */
    public function scopeInArea($query, string $area)
    {
        return $query->where('area_name', 'like', '%' . trim($area) . '%');
    }

    /**
     * Scope query to filter by city.
     */
    public function scopeInCity($query, string $city)
    {
        return $query->where('city', 'like', '%' . trim($city) . '%');
    }
}
