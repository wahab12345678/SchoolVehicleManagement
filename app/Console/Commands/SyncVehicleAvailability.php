<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncVehicleAvailability extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vehicles:sync-availability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync vehicle availability status based on active trips';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Syncing vehicle availability status...');
        
        $vehicles = \App\Models\Vehicle::all();
        $updated = 0;
        
        foreach ($vehicles as $vehicle) {
            $hasActiveTrips = $vehicle->trips()
                ->whereIn('status', ['pending', 'in_progress'])
                ->exists();
            
            $vehicle->update(['is_available' => !$hasActiveTrips]);
            $updated++;
        }
        
        $this->info("Updated availability for {$updated} vehicles.");
        
        // Show summary
        $available = \App\Models\Vehicle::where('is_available', true)->count();
        $inUse = \App\Models\Vehicle::where('is_available', false)->count();
        
        $this->info("Summary:");
        $this->info("- Available vehicles: {$available}");
        $this->info("- In use vehicles: {$inUse}");
        
        return 0;
    }
}
