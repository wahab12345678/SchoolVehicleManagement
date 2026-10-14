<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'number_plate',
        'model',
        'type',
        'capacity',
        'driver_id',
        'school_id',
        'is_available',
        'status',
        'notes'
    ];

    public function getCapacityAttribute($value)
    {
        if (!empty($value)) {
            return (int) $value;
        }

        return match (strtolower($this->type ?? '')) {
            'rickshaw' => 4,
            'car' => 4,
            'van' => 14,
            'bus' => 30,
            default => 10,
        };
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
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
        return $this->hasMany(Trip::class)->whereIn('status', ['pending', 'en_route', 'arrived', 'in_progress']);
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
