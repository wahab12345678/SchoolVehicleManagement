<?php

namespace App\Jobs;

use App\Models\Vehicle;
use App\Models\Trip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class UpdateVehicleAvailability implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vehicleId;

    /**
     * Create a new job instance.
     */
    public function __construct($vehicleId)
    {
        $this->vehicleId = $vehicleId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $vehicle = Vehicle::find($this->vehicleId);
        
        if (!$vehicle) {
            return;
        }

        // Check if vehicle has active trips
        $hasActiveTrips = Trip::where('vehicle_id', $this->vehicleId)
            ->whereIn('status', ['pending', 'in_progress'])
            ->exists();

        // Update vehicle availability
        $vehicle->update([
            'is_available' => !$hasActiveTrips,
            'status' => $hasActiveTrips ? 'in_use' : 'available'
        ]);

        // Clear related caches
        Cache::forget('dashboard_stats');
        Cache::forget('dashboard_active_trips');
        Cache::forget('vehicles_list');
        
        // Clear vehicle-specific cache
        Cache::tags(['vehicles', 'dashboard'])->flush();
    }
}
