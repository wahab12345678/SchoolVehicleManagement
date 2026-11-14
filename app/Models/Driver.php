<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Driver extends User
{
    protected $table = 'users';

    /**
     * Map morph class to User so Spatie role associations match users table.
     */
    public function getMorphClass()
    {
        return User::class;
    }

    /**
     * Boot the model and enforce driver role global scope.
     */
    protected static function booted()
    {
        static::addGlobalScope('driver_role', function (Builder $builder) {
            $builder->whereHas('roles', function ($q) {
                $q->where('name', 'driver');
            });
        });
    }

    /**
     * Service areas covered by this driver.
     */
    public function serviceAreas()
    {
        return $this->hasMany(DriverServiceArea::class, 'driver_id');
    }

    /**
     * Only active service areas for this driver.
     */
    public function activeServiceAreas()
    {
        return $this->hasMany(DriverServiceArea::class, 'driver_id')->where('is_active', true);
    }

    /**
     * Vehicles assigned to this driver.
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'driver_id');
    }

    /**
     * Primary vehicle for this driver.
     */
    public function primaryVehicle()
    {
        return $this->hasOne(Vehicle::class, 'driver_id');
    }

    /**
     * Students currently assigned to this driver.
     */
    public function assignedStudents()
    {
        return $this->hasMany(Student::class, 'driver_id');
    }

    /**
     * Trips conducted by this driver.
     */
    public function trips()
    {
        return $this->hasMany(Trip::class, 'driver_id');
    }
}
