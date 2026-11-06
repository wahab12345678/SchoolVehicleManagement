<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'roll_number',
        'class',
        'parent_id',
        'school_id',
        'driver_id',
        'latitude',
        'longitude',
    ];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'parent_id');
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
<<<<<<< HEAD
        return $this->hasMany(Trip::class)->whereIn('status', ['pending', 'en_route', 'arrived', 'in_progress']);
=======
        return $this->hasMany(Trip::class)->whereIn('status', Trip::ACTIVE_STATUSES);
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
    }

    public function completedTrips()
    {
        return $this->hasMany(Trip::class)->where('status', 'completed');
    }
}
