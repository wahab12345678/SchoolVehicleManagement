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
<<<<<<< HEAD
        return $this->hasMany(Trip::class)->whereIn('status', ['pending', 'en_route', 'arrived', 'in_progress']);
=======
        return $this->hasMany(Trip::class)->whereIn('status', Trip::ACTIVE_STATUSES);
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
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
