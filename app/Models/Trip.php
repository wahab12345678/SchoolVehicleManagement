<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trip extends Model
{
    protected $fillable = [
        'vehicle_id',
        'route_id',
        'driver_id',
        'student_id',
        'school_id',
        'status',
        'started_at',
        'ended_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        // Update vehicle availability when trip status changes
        static::saved(function ($trip) {
            if ($trip->vehicle) {
                $trip->vehicle->updateAvailability();
            }
            
            // Clear related caches for better performance
            \Cache::forget('dashboard_stats');
            \Cache::forget('dashboard_active_trips');
            \Cache::forget('dashboard_recent_trips');
            \Cache::tags(['trips', 'dashboard'])->flush();
        });

        static::deleted(function ($trip) {
            if ($trip->vehicle) {
                $trip->vehicle->updateAvailability();
            }
            
            // Clear related caches for better performance
            \Cache::forget('dashboard_stats');
            \Cache::forget('dashboard_active_trips');
            \Cache::forget('dashboard_recent_trips');
            \Cache::tags(['trips', 'dashboard'])->flush();
        });
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function locations()
    {
        return $this->hasMany(TripLocation::class)->orderBy('recorded_at');
    }

    public function getDurationAttribute()
    {
        if ($this->started_at && $this->ended_at) {
            return $this->started_at->diffInMinutes($this->ended_at);
        }
        return null;
    }

    public function getIsActiveAttribute()
    {
        return in_array($this->status, ['pending', 'in_progress']);
    }

    public function getCurrentLocationAttribute()
    {
        return $this->locations()->latest('recorded_at')->first();
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'in_progress']);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeForStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    public function scopeForGuardian($query, $guardianId)
    {
        return $query->whereHas('student', function($q) use ($guardianId) {
            $q->where('parent_id', $guardianId);
        });
    }
}
