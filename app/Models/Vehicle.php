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
        $type = strtolower($this->type ?? '');

        // Cars are strictly capped at maximum 5 passengers
        if ($type === 'car') {
            $configured = !empty($value) ? (int) $value : 5;
            return min($configured, 5);
        }

        if (!empty($value)) {
            return (int) $value;
        }

        return match ($type) {
            'rickshaw' => 4,
            'van' => 14,
            'bus' => 30,
            default => 10,
        };
    }

    public function getEffectiveCapacityAttribute(): int
    {
        return $this->capacity;
    }

    public function getAssignedStudentsCountAttribute(): int
    {
        return $this->driver_id
            ? Student::where('driver_id', $this->driver_id)->count()
            : 0;
    }

    public function getAvailableSeatsAttribute(): int
    {
        return max(0, $this->capacity - $this->assigned_students_count);
    }

    public function getIsFullAttribute(): bool
    {
        return $this->assigned_students_count >= $this->capacity;
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
