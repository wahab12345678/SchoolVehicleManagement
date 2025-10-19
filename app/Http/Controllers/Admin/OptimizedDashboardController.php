<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OptimizedDashboardController extends Controller
{
    public function index()
    {
        // Cache dashboard data for 5 minutes
        $cacheKey = 'dashboard_optimized_' . now()->format('Y-m-d-H-i');
        
        $data = Cache::remember($cacheKey, 300, function () {
            return [
                'stats' => $this->getOptimizedStats(),
                'recent_trips' => $this->getRecentTrips(),
                'active_trips' => $this->getActiveTrips()
            ];
        });

        return view('admin.dashboard', $data);
    }

    /**
     * Get optimized dashboard statistics using single query
     */
    private function getOptimizedStats()
    {
        return Cache::remember('dashboard_stats_optimized', 300, function () {
            // Single query to get all basic counts
            $counts = DB::select("
                SELECT 
                    (SELECT COUNT(*) FROM students) as total_students,
                    (SELECT COUNT(*) FROM guardians) as total_guardians,
                    (SELECT COUNT(*) FROM vehicles) as total_vehicles,
                    (SELECT COUNT(*) FROM users u 
                     JOIN model_has_roles mhr ON u.id = mhr.model_id 
                     JOIN roles r ON mhr.role_id = r.id 
                     WHERE r.name = 'driver') as total_drivers,
                    (SELECT COUNT(*) FROM routes) as total_routes,
                    (SELECT COUNT(*) FROM trips) as total_trips,
                    (SELECT COUNT(*) FROM trips WHERE status IN ('pending', 'in_progress')) as active_trips,
                    (SELECT COUNT(*) FROM trips WHERE status = 'completed') as completed_trips,
                    (SELECT COUNT(*) FROM vehicles WHERE is_available = 1) as available_vehicles,
                    (SELECT COUNT(*) FROM vehicles WHERE is_available = 0) as in_use_vehicles,
                    (SELECT COUNT(*) FROM vehicles WHERE status = 'maintenance') as maintenance_vehicles
            ")[0];

            return [
                'total_students' => (int) $counts->total_students,
                'total_guardians' => (int) $counts->total_guardians,
                'total_vehicles' => (int) $counts->total_vehicles,
                'total_drivers' => (int) $counts->total_drivers,
                'total_routes' => (int) $counts->total_routes,
                'total_trips' => (int) $counts->total_trips,
                'active_trips' => (int) $counts->active_trips,
                'completed_trips' => (int) $counts->completed_trips,
                'available_vehicles' => (int) $counts->available_vehicles,
                'in_use_vehicles' => (int) $counts->in_use_vehicles,
                'maintenance_vehicles' => (int) $counts->maintenance_vehicles,
                
                // Performance metrics
                'avg_trip_duration' => $this->getCachedAverageTripDuration(),
                'on_time_percentage' => $this->getCachedOnTimePercentage(),
                'popular_route' => $this->getCachedPopularRoute(),
                'safety_score' => 98,
                'incidents' => 0,
                
                // Trend calculations
                'student_trend' => $this->getCachedStudentTrend(),
                'vehicle_trend' => $this->getCachedVehicleTrend(),
                'driver_trend' => $this->getCachedDriverTrend(),
                'trip_trend' => $this->getCachedTripTrend(),
            ];
        });
    }

    /**
     * Get recent trips with optimized query
     */
    private function getRecentTrips()
    {
        return Cache::remember('recent_trips_optimized', 180, function () {
            return \App\Models\Trip::select(['id', 'student_id', 'vehicle_id', 'route_id', 'status', 'created_at'])
                ->with([
                    'student:id,name,roll_number,class',
                    'vehicle:id,number_plate,model',
                    'route:id,name'
                ])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        });
    }

    /**
     * Get active trips with optimized query
     */
    private function getActiveTrips()
    {
        return Cache::remember('active_trips_optimized', 60, function () {
            return \App\Models\Trip::select(['id', 'student_id', 'vehicle_id', 'route_id', 'status', 'started_at', 'created_at'])
                ->with([
                    'student:id,name,roll_number,class',
                    'vehicle:id,number_plate,model',
                    'route:id,name'
                ])
                ->whereIn('status', ['pending', 'in_progress'])
                ->orderBy('created_at', 'desc')
                ->get();
        });
    }

    /**
     * Get cached average trip duration
     */
    private function getCachedAverageTripDuration()
    {
        return Cache::remember('avg_trip_duration', 600, function () {
            $result = DB::select("
                SELECT AVG(TIMESTAMPDIFF(MINUTE, started_at, ended_at)) as avg_duration
                FROM trips 
                WHERE status = 'completed' 
                AND started_at IS NOT NULL 
                AND ended_at IS NOT NULL
            ");
            
            return $result[0]->avg_duration ? round($result[0]->avg_duration, 1) : 0;
        });
    }

    /**
     * Get cached on-time percentage
     */
    private function getCachedOnTimePercentage()
    {
        return Cache::remember('on_time_percentage', 600, function () {
            $result = DB::select("
                SELECT 
                    COUNT(*) as total_trips,
                    SUM(CASE WHEN ended_at <= expected_end_time THEN 1 ELSE 0 END) as on_time_trips
                FROM trips 
                WHERE status = 'completed' 
                AND started_at IS NOT NULL 
                AND ended_at IS NOT NULL
            ");
            
            if ($result[0]->total_trips > 0) {
                return round(($result[0]->on_time_trips / $result[0]->total_trips) * 100, 1);
            }
            
            return 0;
        });
    }

    /**
     * Get cached popular route
     */
    private function getCachedPopularRoute()
    {
        return Cache::remember('popular_route', 600, function () {
            $result = DB::select("
                SELECT r.name, COUNT(t.id) as trip_count
                FROM routes r
                LEFT JOIN trips t ON r.id = t.route_id
                GROUP BY r.id, r.name
                ORDER BY trip_count DESC
                LIMIT 1
            ");
            
            return $result[0]->name ?? 'No Route';
        });
    }

    /**
     * Get cached student trend
     */
    private function getCachedStudentTrend()
    {
        return Cache::remember('student_trend', 300, function () {
            $currentMonth = \App\Models\Student::whereMonth('created_at', now()->month)->count();
            $lastMonth = \App\Models\Student::whereMonth('created_at', now()->subMonth()->month)->count();
            
            if ($lastMonth == 0) {
                $totalStudents = \App\Models\Student::count();
                if ($totalStudents > 0) {
                    return ['percentage' => 100, 'direction' => 'up'];
                }
                return ['percentage' => 0, 'direction' => 'neutral'];
            }
            
            $percentage = round((($currentMonth - $lastMonth) / $lastMonth) * 100);
            $direction = $percentage > 0 ? 'up' : ($percentage < 0 ? 'down' : 'neutral');
            
            return ['percentage' => abs($percentage), 'direction' => $direction];
        });
    }

    /**
     * Get cached vehicle trend
     */
    private function getCachedVehicleTrend()
    {
        return Cache::remember('vehicle_trend', 300, function () {
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
        });
    }

    /**
     * Get cached driver trend
     */
    private function getCachedDriverTrend()
    {
        return Cache::remember('driver_trend', 300, function () {
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
        });
    }

    /**
     * Get cached trip trend
     */
    private function getCachedTripTrend()
    {
        return Cache::remember('trip_trend', 300, function () {
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
        });
    }

    /**
     * Get chart data with optimized queries
     */
    public function getChartData(Request $request)
    {
        $period = $request->get('period', '30');
        
        $cacheKey = "chart_data_{$period}_" . now()->format('Y-m-d-H');
        
        return Cache::remember($cacheKey, 300, function () use ($period) {
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
                $days = (int) $period;
                $startDate = now()->subDays($days);
                $endDate = now();
            }
            
            // Get trip trends data
            $tripTrends = $this->getOptimizedTripTrendsData($startDate, $endDate, $days, $period);
            
            // Get vehicle utilization data
            $vehicleUtilization = $this->getOptimizedVehicleUtilizationData();
            
            return response()->json([
                'tripTrends' => $tripTrends,
                'vehicleUtilization' => $vehicleUtilization,
                'period' => $period
            ]);
        });
    }

    /**
     * Get optimized trip trends data
     */
    private function getOptimizedTripTrendsData($startDate, $endDate, $days, $period = null)
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
                    'fill' => false
                ],
                [
                    'label' => 'Active Trips',
                    'data' => $activeData,
                    'borderColor' => '#ff9f43',
                    'backgroundColor' => 'rgba(255, 159, 67, 0.1)',
                    'fill' => false
                ]
            ]
        ];
    }

    /**
     * Get optimized vehicle utilization data
     */
    private function getOptimizedVehicleUtilizationData()
    {
        return Cache::remember('vehicle_utilization_optimized', 300, function () {
            $vehicles = \App\Models\Vehicle::select('id', 'number_plate', 'model')
                ->withCount(['trips' => function($query) {
                    $query->where('status', 'completed');
                }])
                ->get();

            $labels = $vehicles->pluck('number_plate')->toArray();
            $data = $vehicles->pluck('trips_count')->toArray();

            return [
                'labels' => $labels,
                'data' => $data
            ];
        });
    }

    /**
     * Clear all dashboard caches
     */
    public function clearCache()
    {
        Cache::forget('dashboard_stats_optimized');
        Cache::forget('recent_trips_optimized');
        Cache::forget('active_trips_optimized');
        Cache::forget('avg_trip_duration');
        Cache::forget('on_time_percentage');
        Cache::forget('popular_route');
        Cache::forget('student_trend');
        Cache::forget('vehicle_trend');
        Cache::forget('driver_trend');
        Cache::forget('trip_trend');
        Cache::forget('vehicle_utilization_optimized');
        
        return response()->json(['message' => 'Dashboard cache cleared successfully']);
    }
}
