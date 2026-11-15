<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get dashboard statistics with caching for better performance
        $stats = Cache::remember('dashboard_stats_optimized', 300, function () {
            return [
                'total_students' => $this->getValidatedCount(\App\Models\Student::class),
                'total_guardians' => $this->getValidatedCount(\App\Models\Guardian::class),
                'total_vehicles' => $this->getValidatedCount(\App\Models\Vehicle::class),
                'total_drivers' => $this->getValidatedDriverCount(),
                'total_routes' => $this->getValidatedCount(\App\Models\Route::class),
                'total_trips' => $this->getValidatedCount(\App\Models\Trip::class),
                'active_trips' => $this->getValidatedActiveTripsCount(),
                'completed_trips' => $this->getValidatedCompletedTripsCount(),
                
                // Enhanced statistics
                'available_vehicles' => $this->getAvailableVehiclesCount(),
                'in_use_vehicles' => $this->getInUseVehiclesCount(),
                'maintenance_vehicles' => $this->getMaintenanceVehiclesCount(),
                
                // Performance metrics
                'avg_trip_duration' => $this->getAverageTripDuration(),
                'on_time_percentage' => $this->getOnTimePercentage(),
                'popular_route' => $this->getPopularRoute(),
                'safety_score' => $this->getSafetyScore(),
                'incidents' => 0, // Placeholder for incident tracking
                
                // Trend calculations
                'student_trend' => $this->getStudentTrend(),
                'vehicle_trend' => $this->getVehicleTrend(),
                'driver_trend' => $this->getDriverTrend(),
                'trip_trend' => $this->getTripTrend(),
            ];
        });

        // Get recent trips with optimized queries
        $recent_trips = \Cache::remember('dashboard_recent_trips', 300, function () {
            return \App\Models\Trip::with(['student:id,name,class', 'vehicle:id,number_plate,model', 'route:id,name'])
                ->select('id', 'student_id', 'vehicle_id', 'route_id', 'status', 'created_at')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        });

        // Get active trips for real-time tracking with caching
        $active_trips = \Cache::remember('dashboard_active_trips', 60, function () {
            return \App\Models\Trip::with(['student:id,name,class', 'vehicle:id,number_plate,model', 'route:id,name'])
                ->select('id', 'student_id', 'vehicle_id', 'route_id', 'status', 'created_at', 'started_at')
                ->whereIn('status', ['pending', 'in_progress'])
                ->orderBy('created_at', 'desc')
                ->get();
        });

        return view('admin.dashboard', compact('stats', 'recent_trips', 'active_trips'));
    }

    public function getChartData(Request $request)
    {
        $period = $request->get('period', '30'); // Default to 30 days
        
        // Cache chart data for better performance
        $cacheKey = "chart_data_{$period}";
        $cacheTime = in_array($period, ['7', 'this_week']) ? 60 : 300; // Shorter cache for recent data
        
        return \Cache::remember($cacheKey, $cacheTime, function () use ($period) {
            // Handle different period types
            if ($period === 'this_week') {
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                $days = 7;
            } elseif ($period === 'this_month') {
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                $days = now()->daysInMonth;
            } elseif ($period === 'this_year') {
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                $days = 365;
            } else {
                // Handle numeric periods (7, 30, 90 days)
                $days = (int) $period;
                $startDate = now()->subDays($days);
                $endDate = now();
            }
            
            // Get trip trends data
            $tripTrends = $this->getTripTrendsData($startDate, $endDate, $days, $period);
            
            // Get vehicle utilization data
            $vehicleUtilization = $this->getVehicleUtilizationData();
            
            return response()->json([
                'tripTrends' => $tripTrends,
                'vehicleUtilization' => $vehicleUtilization,
                'period' => $period
            ]);
        });
    }

    private function getTripTrendsData($startDate, $endDate, $days, $period = null)
    {
        $labels = [];
        $completedData = [];
        $activeData = [];
        
        if ($period === 'this_week') {
            // Daily data for this week
            for ($i = 0; $i < 7; $i++) {
                $date = $startDate->copy()->addDays($i);
                $labels[] = $date->format('D');
                
                $completed = \App\Models\Trip::where('status', 'completed')
                    ->whereDate('created_at', $date)
                    ->count();
                $completedData[] = $completed;
                
                $active = \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])
                    ->whereDate('created_at', $date)
                    ->count();
                $activeData[] = $active;
            }
        } elseif ($period === 'this_month') {
            // Daily data for this month
            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                $labels[] = $currentDate->format('M j');
                
                $completed = \App\Models\Trip::where('status', 'completed')
                    ->whereDate('created_at', $currentDate)
                    ->count();
                $completedData[] = $completed;
                
                $active = \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])
                    ->whereDate('created_at', $currentDate)
                    ->count();
                $activeData[] = $active;
                
                $currentDate->addDay();
            }
        } elseif ($period === 'this_year') {
            // Monthly data for this year
            for ($i = 1; $i <= 12; $i++) {
                $monthStart = now()->startOfYear()->addMonths($i - 1);
                $monthEnd = $monthStart->copy()->endOfMonth();
                $labels[] = $monthStart->format('M');
                
                $completed = \App\Models\Trip::where('status', 'completed')
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->count();
                $completedData[] = $completed;
                
                $active = \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->count();
                $activeData[] = $active;
            }
        } elseif ($days <= 7) {
            // Daily data for last 7 days
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $labels[] = $date->format('D');
                
                $completed = \App\Models\Trip::where('status', 'completed')
                    ->whereDate('created_at', $date)
                    ->count();
                $completedData[] = $completed;
                
                $active = \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])
                    ->whereDate('created_at', $date)
                    ->count();
                $activeData[] = $active;
            }
        } else {
            // Weekly data for longer periods
            $weeks = ceil($days / 7);
            for ($i = $weeks - 1; $i >= 0; $i--) {
                $weekStart = now()->subWeeks($i)->startOfWeek();
                $weekEnd = now()->subWeeks($i)->endOfWeek();
                $labels[] = 'Week ' . ($weeks - $i);
                
                $completed = \App\Models\Trip::where('status', 'completed')
                    ->whereBetween('created_at', [$weekStart, $weekEnd])
                    ->count();
                $completedData[] = $completed;
                
                $active = \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])
                    ->whereBetween('created_at', [$weekStart, $weekEnd])
                    ->count();
                $activeData[] = $active;
            }
        }
        
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Completed Trips',
                    'data' => $completedData,
                    'borderColor' => '#28c76f',
                    'backgroundColor' => 'rgba(40, 199, 111, 0.1)',
                    'tension' => 0.4
                ],
                [
                    'label' => 'Active Trips',
                    'data' => $activeData,
                    'borderColor' => '#ff9f43',
                    'backgroundColor' => 'rgba(255, 159, 67, 0.1)',
                    'tension' => 0.4
                ]
            ]
        ];
    }

    private function getVehicleUtilizationData()
    {
        $available = \App\Models\Vehicle::where('is_available', true)->count();
        $inUse = \App\Models\Vehicle::where('is_available', false)->count();
        $maintenance = \App\Models\Vehicle::where('status', 'maintenance')->count();
        
        return [
            'labels' => ['Available', 'In Use', 'Maintenance'],
            'data' => [$available, $inUse, $maintenance],
            'backgroundColor' => ['#28c76f', '#ff9f43', '#ea5455']
        ];
    }

    private function getAverageTripDuration()
    {
        // Calculate average trip duration in minutes
        $trips = \App\Models\Trip::where('status', 'completed')
            ->whereNotNull('started_at')
            ->whereNotNull('ended_at')
            ->get();
        
        if ($trips->count() == 0) return 25; // Default value
        
        $totalMinutes = $trips->sum(function($trip) {
            return $trip->started_at->diffInMinutes($trip->ended_at);
        });
        
        return round($totalMinutes / $trips->count());
    }

    private function getOnTimePercentage()
    {
        // Calculate on-time percentage (placeholder logic)
        $totalTrips = \App\Models\Trip::where('status', 'completed')->count();
        if ($totalTrips == 0) return 95; // Default value
        
        // For now, return a high percentage as placeholder
        return 95;
    }

    private function getPopularRoute()
    {
        $popularRoute = \App\Models\Route::withCount('trips')
            ->orderBy('trips_count', 'desc')
            ->first();
        
        return $popularRoute ? $popularRoute->name : 'Route A';
    }

    private function getSafetyScore()
    {
        // Calculate safety score based on various factors
        // For now, return a high score as placeholder
        return 98;
    }

    private function getAvailableVehiclesCount()
    {
        try {
            // First try to use the is_available column
            return \App\Models\Vehicle::where('is_available', true)->count();
        } catch (\Exception $e) {
            // Fallback to calculating availability based on active trips
            return \App\Models\Vehicle::whereDoesntHave('trips', function($query) {
                $query->whereIn('status', ['pending', 'in_progress']);
            })->count();
        }
    }

    private function getInUseVehiclesCount()
    {
        try {
            // First try to use the is_available column
            return \App\Models\Vehicle::where('is_available', false)->count();
        } catch (\Exception $e) {
            // Fallback to calculating based on active trips
            return \App\Models\Vehicle::whereHas('trips', function($query) {
                $query->whereIn('status', ['pending', 'in_progress']);
            })->count();
        }
    }

    private function getMaintenanceVehiclesCount()
    {
        try {
            // Count vehicles with maintenance status
            return \App\Models\Vehicle::where('status', 'maintenance')->count();
        } catch (\Exception $e) {
            // Fallback to 0 if status column doesn't exist
            return 0;
        }
    }

    private function getStudentTrend()
    {
        $currentMonth = \App\Models\Student::whereMonth('created_at', now()->month)->count();
        $lastMonth = \App\Models\Student::whereMonth('created_at', now()->subMonth()->month)->count();
        
        if ($lastMonth == 0) {
            // If no data from last month, check if we have any students at all
            $totalStudents = \App\Models\Student::count();
            if ($totalStudents > 0) {
                return ['percentage' => 100, 'direction' => 'up'];
            }
            return ['percentage' => 0, 'direction' => 'neutral'];
        }
        
        $percentage = round((($currentMonth - $lastMonth) / $lastMonth) * 100);
        $direction = $percentage > 0 ? 'up' : ($percentage < 0 ? 'down' : 'neutral');
        
        return ['percentage' => abs($percentage), 'direction' => $direction];
    }

    private function getVehicleTrend()
    {
        $currentMonth = \App\Models\Vehicle::whereMonth('created_at', now()->month)->count();
        $lastMonth = \App\Models\Vehicle::whereMonth('created_at', now()->subMonth()->month)->count();
        
        if ($lastMonth == 0) {
            $totalVehicles = \App\Models\Vehicle::count();
            if ($totalVehicles > 0) {
                return ['percentage' => 100, 'direction' => 'up'];
            }
            return ['percentage' => 0, 'direction' => 'neutral'];
        }
        
        $percentage = round((($currentMonth - $lastMonth) / $lastMonth) * 100);
        $direction = $percentage > 0 ? 'up' : ($percentage < 0 ? 'down' : 'neutral');
        
        return ['percentage' => abs($percentage), 'direction' => $direction];
    }

    private function getDriverTrend()
    {
        $currentMonth = \App\Models\User::role('driver')->whereMonth('created_at', now()->month)->count();
        $lastMonth = \App\Models\User::role('driver')->whereMonth('created_at', now()->subMonth()->month)->count();
        
        if ($lastMonth == 0) {
            $totalDrivers = \App\Models\User::role('driver')->count();
            if ($totalDrivers > 0) {
                return ['percentage' => 100, 'direction' => 'up'];
            }
            return ['percentage' => 0, 'direction' => 'neutral'];
        }
        
        $percentage = round((($currentMonth - $lastMonth) / $lastMonth) * 100);
        $direction = $percentage > 0 ? 'up' : ($percentage < 0 ? 'down' : 'neutral');
        
        return ['percentage' => abs($percentage), 'direction' => $direction];
    }

    private function getTripTrend()
    {
        $currentMonth = \App\Models\Trip::whereMonth('created_at', now()->month)->count();
        $lastMonth = \App\Models\Trip::whereMonth('created_at', now()->subMonth()->month)->count();
        
        if ($lastMonth == 0) {
            $totalTrips = \App\Models\Trip::count();
            if ($totalTrips > 0) {
                return ['percentage' => 100, 'direction' => 'up'];
            }
            return ['percentage' => 0, 'direction' => 'neutral'];
        }
        
        $percentage = round((($currentMonth - $lastMonth) / $lastMonth) * 100);
        $direction = $percentage > 0 ? 'up' : ($percentage < 0 ? 'down' : 'neutral');
        
        return ['percentage' => abs($percentage), 'direction' => $direction];
    }

    /**
     * Get validated count for any model with error handling
     */
    private function getValidatedCount($modelClass)
    {
        try {
            return $modelClass::count();
        } catch (\Exception $e) {
            \Log::error("Error counting {$modelClass}: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get validated driver count with role check
     */
    private function getValidatedDriverCount()
    {
        try {
            return \App\Models\User::role('driver')->count();
        } catch (\Exception $e) {
            \Log::error("Error counting drivers: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get validated active trips count
     */
    private function getValidatedActiveTripsCount()
    {
        try {
            return \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])->count();
        } catch (\Exception $e) {
            \Log::error("Error counting active trips: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get validated completed trips count
     */
    private function getValidatedCompletedTripsCount()
    {
        try {
            return \App\Models\Trip::where('status', 'completed')->count();
        } catch (\Exception $e) {
            \Log::error("Error counting completed trips: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Validate trip status consistency
     */
    private function validateTripStatusConsistency()
    {
        try {
            $totalTrips = \App\Models\Trip::count();
            $activeTrips = \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])->count();
            $completedTrips = \App\Models\Trip::where('status', 'completed')->count();
            $cancelledTrips = \App\Models\Trip::where('status', 'cancelled')->count();
            
            $statusTotal = $activeTrips + $completedTrips + $cancelledTrips;
            
            if ($statusTotal !== $totalTrips) {
                \Log::warning("Trip status inconsistency detected: Total={$totalTrips}, StatusTotal={$statusTotal}");
                return false;
            }
            
            return true;
        } catch (\Exception $e) {
            \Log::error("Error validating trip status consistency: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Validate vehicle availability consistency
     */
    private function validateVehicleAvailabilityConsistency()
    {
        try {
            $totalVehicles = \App\Models\Vehicle::count();
            $availableVehicles = \App\Models\Vehicle::where('is_available', true)->count();
            $inUseVehicles = \App\Models\Vehicle::where('is_available', false)->count();
            
            $availabilityTotal = $availableVehicles + $inUseVehicles;
            
            if ($availabilityTotal !== $totalVehicles) {
                \Log::warning("Vehicle availability inconsistency detected: Total={$totalVehicles}, AvailabilityTotal={$availabilityTotal}");
                return false;
            }
            
            return true;
        } catch (\Exception $e) {
            \Log::error("Error validating vehicle availability consistency: " . $e->getMessage());
            return false;
        }
    }
}
