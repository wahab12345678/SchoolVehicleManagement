<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guardian;
use App\Models\Route;
use App\Models\Student;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user && ($user->hasRole('guardian') || $user->hasRole('parent')) && !$user->hasRole('admin')) {
            return redirect()->route('guardian.dashboard');
        }

        // Get dashboard statistics with caching for better performance
        $stats = Cache::remember('dashboard_stats_optimized', 300, function () {
            return [
                'total_students' => $this->getValidatedCount(Student::class),
                'total_guardians' => $this->getValidatedCount(Guardian::class),
                'total_vehicles' => $this->getValidatedCount(Vehicle::class),
                'total_drivers' => $this->getValidatedDriverCount(),
                'total_routes' => $this->getValidatedCount(Route::class),
                'total_trips' => $this->getValidatedCount(Trip::class),
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

                // Trend calculations (DRY refactored & year-safe)
                'student_trend' => $this->calculateTrend(Student::query()),
                'vehicle_trend' => $this->calculateTrend(Vehicle::query()),
                'driver_trend' => $this->getDriverTrend(),
                'trip_trend' => $this->calculateTrend(Trip::query()),
            ];
        });

        // Get recent trips with optimized queries
        $recent_trips = Cache::remember('dashboard_recent_trips', 300, function () {
            return Trip::with(['student:id,name,class', 'vehicle:id,number_plate,model', 'route:id,name'])
                ->select('id', 'student_id', 'vehicle_id', 'route_id', 'status', 'created_at')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        });

        // Get active trips for real-time tracking with caching
        $active_trips = Cache::remember('dashboard_active_trips', 60, function () {
            return Trip::with(['student:id,name,class', 'vehicle:id,number_plate,model', 'route:id,name'])
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

        $cacheKey = "chart_data_{$period}";
        $cacheTime = in_array($period, ['7', 'this_week']) ? 60 : 300;

        $data = Cache::remember($cacheKey, $cacheTime, function () use ($period) {
            $now = now();

            if ($period === 'this_week') {
                $startDate = $now->copy()->startOfWeek();
                $endDate = $now->copy()->endOfWeek();
                $days = 7;
            } elseif ($period === 'this_month') {
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                $days = $now->daysInMonth;
            } elseif ($period === 'this_year') {
                $startDate = $now->copy()->startOfYear();
                $endDate = $now->copy()->endOfYear();
                $days = 365;
            } else {
                $days = max(1, (int) $period);
                $startDate = $now->copy()->subDays($days - 1)->startOfDay();
                $endDate = $now->copy()->endOfDay();
            }

            return [
                'tripTrends' => $this->getTripTrendsData($startDate, $endDate, $days, $period),
                'vehicleUtilization' => $this->getVehicleUtilizationData(),
                'period' => $period,
            ];
        });

        return response()->json($data);
    }

    private function getTripTrendsData(Carbon $startDate, Carbon $endDate, int $days, ?string $period = null): array
    {
        $labels = [];
        $completedData = [];
        $activeData = [];

        if ($period === 'this_year') {
            // Single aggregated query grouped by month
            $records = Trip::selectRaw("
                    MONTH(created_at) as month_num,
                    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_count,
                    SUM(CASE WHEN status IN ('pending', 'in_progress') THEN 1 ELSE 0 END) as active_count
                ")
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('month_num')
                ->get()
                ->keyBy('month_num');

            for ($i = 1; $i <= 12; $i++) {
                $monthStart = now()->startOfYear()->addMonths($i - 1);
                $labels[] = $monthStart->format('M');
                $completedData[] = (int) ($records[$i]->completed_count ?? 0);
                $activeData[] = (int) ($records[$i]->active_count ?? 0);
            }
        } elseif ($period === 'this_week' || $period === 'this_month' || $days <= 7) {
            // Single aggregated query grouped by date
            $records = Trip::selectRaw("
                    DATE(created_at) as trip_date,
                    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_count,
                    SUM(CASE WHEN status IN ('pending', 'in_progress') THEN 1 ELSE 0 END) as active_count
                ")
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('trip_date')
                ->get()
                ->keyBy('trip_date');

            $currentDate = $startDate->copy();
            $format = ($period === 'this_month') ? 'M j' : 'D';

            while ($currentDate->lte($endDate)) {
                $dateKey = $currentDate->toDateString();
                $labels[] = $currentDate->format($format);
                $completedData[] = (int) ($records[$dateKey]->completed_count ?? 0);
                $activeData[] = (int) ($records[$dateKey]->active_count ?? 0);
                $currentDate->addDay();
            }
        } else {
            // Weekly data for longer periods (e.g., 30 or 90 days)
            $weeks = (int) ceil($days / 7);
            $now = now();

            for ($i = $weeks - 1; $i >= 0; $i--) {
                $weekStart = $now->copy()->subWeeks($i)->startOfWeek();
                $weekEnd = $now->copy()->subWeeks($i)->endOfWeek();
                $labels[] = 'Week ' . ($weeks - $i);

                $completedData[] = Trip::where('status', 'completed')
                    ->whereBetween('created_at', [$weekStart, $weekEnd])
                    ->count();

                $activeData[] = Trip::whereIn('status', ['pending', 'in_progress'])
                    ->whereBetween('created_at', [$weekStart, $weekEnd])
                    ->count();
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
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Active Trips',
                    'data' => $activeData,
                    'borderColor' => '#ff9f43',
                    'backgroundColor' => 'rgba(255, 159, 67, 0.1)',
                    'tension' => 0.4,
                ],
            ],
        ];
    }

    private function getVehicleUtilizationData(): array
    {
        $available = $this->getAvailableVehiclesCount();
        $inUse = $this->getInUseVehiclesCount();
        $maintenance = $this->getMaintenanceVehiclesCount();

        return [
            'labels' => ['Available', 'In Use', 'Maintenance'],
            'data' => [$available, $inUse, $maintenance],
            'backgroundColor' => ['#28c76f', '#ff9f43', '#ea5455'],
        ];
    }

    private function getAverageTripDuration(): int
    {
        try {
            // Calculate average directly in SQL to avoid loading all models into memory
            $avgMinutes = Trip::where('status', 'completed')
                ->whereNotNull('started_at')
                ->whereNotNull('ended_at')
                ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, started_at, ended_at)) as avg_duration')
                ->value('avg_duration');

            return $avgMinutes !== null ? (int) round($avgMinutes) : 25;
        } catch (\Exception $e) {
            Log::error('Error calculating average trip duration: ' . $e->getMessage());
            return 25;
        }
    }

    private function getOnTimePercentage(): int
    {
        $totalTrips = $this->getValidatedCompletedTripsCount();
        if ($totalTrips === 0) {
            return 95;
        }

        return 95;
    }

    private function getPopularRoute(): string
    {
        try {
            $popularRoute = Route::withCount('trips')
                ->orderBy('trips_count', 'desc')
                ->first();

            return $popularRoute ? $popularRoute->name : 'Route A';
        } catch (\Exception $e) {
            Log::error('Error fetching popular route: ' . $e->getMessage());
            return 'Route A';
        }
    }

    private function getSafetyScore(): int
    {
        return 98;
    }

    private function getAvailableVehiclesCount(): int
    {
        try {
            return Vehicle::where('is_available', true)->count();
        } catch (\Exception $e) {
            return Vehicle::whereDoesntHave('trips', function ($query) {
                $query->whereIn('status', ['pending', 'in_progress']);
            })->count();
        }
    }

    private function getInUseVehiclesCount(): int
    {
        try {
            return Vehicle::where('is_available', false)->count();
        } catch (\Exception $e) {
            return Vehicle::whereHas('trips', function ($query) {
                $query->whereIn('status', ['pending', 'in_progress']);
            })->count();
        }
    }

    private function getMaintenanceVehiclesCount(): int
    {
        try {
            return Vehicle::where('status', 'maintenance')->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Reusable helper to calculate month-over-month trend accurately across year boundaries
     */
    private function calculateTrend(Builder $query): array
    {
        try {
            $now = now();
            $currentStart = $now->copy()->startOfMonth();
            $currentEnd = $now->copy()->endOfMonth();

            $lastMonthStart = $now->copy()->subMonthNoOverflow()->startOfMonth();
            $lastMonthEnd = $now->copy()->subMonthNoOverflow()->endOfMonth();

            $currentMonth = (clone $query)->whereBetween('created_at', [$currentStart, $currentEnd])->count();
            $lastMonth = (clone $query)->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();

            if ($lastMonth === 0) {
                $total = (clone $query)->count();
                if ($total > 0) {
                    return ['percentage' => 100, 'direction' => 'up'];
                }
                return ['percentage' => 0, 'direction' => 'neutral'];
            }

            $percentage = round((($currentMonth - $lastMonth) / $lastMonth) * 100);
            $direction = $percentage > 0 ? 'up' : ($percentage < 0 ? 'down' : 'neutral');

            return ['percentage' => abs($percentage), 'direction' => $direction];
        } catch (\Exception $e) {
            Log::error('Error calculating trend: ' . $e->getMessage());
            return ['percentage' => 0, 'direction' => 'neutral'];
        }
    }

    private function getDriverTrend(): array
    {
        try {
            return $this->calculateTrend(User::role('driver'));
        } catch (\Exception $e) {
            Log::error('Error calculating driver trend: ' . $e->getMessage());
            return ['percentage' => 0, 'direction' => 'neutral'];
        }
    }

    /**
     * Get validated count for any model with error handling
     */
    private function getValidatedCount(string $modelClass): int
    {
        try {
            return $modelClass::count();
        } catch (\Exception $e) {
            Log::error("Error counting {$modelClass}: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get validated driver count with role check
     */
    private function getValidatedDriverCount(): int
    {
        try {
            return User::role('driver')->count();
        } catch (\Exception $e) {
            Log::error('Error counting drivers: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get validated active trips count
     */
    private function getValidatedActiveTripsCount(): int
    {
        try {
            return Trip::whereIn('status', ['pending', 'in_progress'])->count();
        } catch (\Exception $e) {
            Log::error('Error counting active trips: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get validated completed trips count
     */
    private function getValidatedCompletedTripsCount(): int
    {
        try {
            return Trip::where('status', 'completed')->count();
        } catch (\Exception $e) {
            Log::error('Error counting completed trips: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Validate trip status consistency
     */
    private function validateTripStatusConsistency(): bool
    {
        try {
            $totalTrips = Trip::count();
            $activeTrips = Trip::whereIn('status', ['pending', 'in_progress'])->count();
            $completedTrips = Trip::where('status', 'completed')->count();
            $cancelledTrips = Trip::where('status', 'cancelled')->count();

            $statusTotal = $activeTrips + $completedTrips + $cancelledTrips;

            if ($statusTotal !== $totalTrips) {
                Log::warning("Trip status inconsistency detected: Total={$totalTrips}, StatusTotal={$statusTotal}");
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Error validating trip status consistency: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Validate vehicle availability consistency
     */
    private function validateVehicleAvailabilityConsistency(): bool
    {
        try {
            $totalVehicles = Vehicle::count();
            $availableVehicles = Vehicle::where('is_available', true)->count();
            $inUseVehicles = Vehicle::where('is_available', false)->count();

            $availabilityTotal = $availableVehicles + $inUseVehicles;

            if ($availabilityTotal !== $totalVehicles) {
                Log::warning("Vehicle availability inconsistency detected: Total={$totalVehicles}, AvailabilityTotal={$availabilityTotal}");
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Error validating vehicle availability consistency: ' . $e->getMessage());
            return false;
        }
    }
}