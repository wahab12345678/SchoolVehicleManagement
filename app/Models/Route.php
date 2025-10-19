<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'name',
        'description',
        'school_id'
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function activeTrips()
    {
        return $this->hasMany(Trip::class)->whereIn('status', ['pending', 'in_progress']);
    }

    public function getActiveTripsCountAttribute()
    {
        return $this->activeTrips()->count();
    }

    public function scopeWithActiveTrips($query)
    {
        return $query->whereHas('activeTrips');
    }
}
