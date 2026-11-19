<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Admin\DashboardController;

class UpdateDashboardCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $controller = new DashboardController();
        
        // Pre-warm dashboard cache
        Cache::remember('dashboard_stats', 300, function () use ($controller) {
            return [
                'total_students' => \App\Models\Student::count(),
                'total_guardians' => \App\Models\Guardian::count(),
                'total_vehicles' => \App\Models\Vehicle::count(),
                'total_drivers' => \App\Models\User::role('driver')->count(),
                'total_routes' => \App\Models\Route::count(),
                'total_trips' => \App\Models\Trip::count(),
                'active_trips' => \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])->count(),
                'completed_trips' => \App\Models\Trip::where('status', 'completed')->count(),
            ];
        });

        // Pre-warm recent trips cache
        Cache::remember('dashboard_recent_trips', 300, function () {
            return \App\Models\Trip::with(['student:id,name,class', 'vehicle:id,number_plate,model', 'route:id,name'])
                ->select('id', 'student_id', 'vehicle_id', 'route_id', 'status', 'created_at')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        });

        // Pre-warm active trips cache
        Cache::remember('dashboard_active_trips', 60, function () {
            return \App\Models\Trip::with(['student:id,name,class', 'vehicle:id,number_plate,model', 'route:id,name'])
                ->select('id', 'student_id', 'vehicle_id', 'route_id', 'status', 'created_at', 'started_at')
                ->whereIn('status', ['pending', 'in_progress'])
                ->orderBy('created_at', 'desc')
                ->get();
        });
    }
}
