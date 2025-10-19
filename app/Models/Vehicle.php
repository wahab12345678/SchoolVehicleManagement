<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'number_plate',
        'model',
        'type',
        'driver_id',
        'school_id',
        'is_available',
        'status',
        'notes'
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function activeTrips()
    {
        return $this->hasMany(Trip::class)->whereIn('status', ['pending', 'in_progress']);
    }

    public function getIsAvailableAttribute()
    {
        return $this->activeTrips()->count() === 0;
    }

    public function updateAvailability()
    {
        $hasActiveTrips = $this->activeTrips()->count() > 0;
        $this->update(['is_available' => !$hasActiveTrips]);
        return $this;
    }

    public function scopeAvailable($query)
    {
        return $query->whereDoesntHave('activeTrips');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeUnassigned($query)
    {
        return $query->whereNull('driver_id');
    }
}
