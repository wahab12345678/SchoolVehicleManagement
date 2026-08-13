<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TripLocation extends Model
{
    protected $fillable = [
        'trip_id',
        'latitude',
        'longitude',
        'accuracy',
        'heading',
        'speed',
        'recorded_at',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'accuracy' => 'decimal:2',
        'heading' => 'decimal:2',
        'speed' => 'decimal:2',
        'recorded_at' => 'datetime',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function getFormattedLocationAttribute()
    {
        return $this->latitude . ', ' . $this->longitude;
    }

    public function getGoogleMapsUrlAttribute()
    {
        return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
    }

    public function scopeRecent($query, $minutes = 30)
    {
        return $query->where('recorded_at', '>=', Carbon::now()->subMinutes($minutes));
    }

    public function scopeForTrip($query, $tripId)
    {
        return $query->where('trip_id', $tripId);
    }
}
