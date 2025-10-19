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
        'latitude',
        'longitude',
        'registration_no'
    ];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'parent_id');
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

    public function completedTrips()
    {
        return $this->hasMany(Trip::class)->where('status', 'completed');
    }
}
