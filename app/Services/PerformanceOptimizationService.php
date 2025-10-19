<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PerformanceOptimizationService
{
    /**
     * Optimize database queries
     */
    public function optimizeQueries()
    {
        // Enable query logging for optimization
        DB::enableQueryLog();
        
        // Run common queries to identify slow ones
        $this->testCommonQueries();
        
        $queries = DB::getQueryLog();
        $slowQueries = array_filter($queries, function($query) {
            return $query['time'] > 100; // More than 100ms
        });
        
        if (!empty($slowQueries)) {
            Log::warning('Slow queries detected', $slowQueries);
        }
        
        return [
            'total_queries' => count($queries),
            'slow_queries' => count($slowQueries),
            'queries' => $queries
        ];
    }

    /**
     * Test common queries
     */
    private function testCommonQueries()
    {
        // Test dashboard queries
        \App\Models\Student::count();
        \App\Models\Guardian::count();
        \App\Models\Vehicle::count();
        \App\Models\Trip::count();
        \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])->count();
        
        // Test relationship queries
        \App\Models\Student::with('guardian')->limit(10)->get();
        \App\Models\Trip::with(['student', 'vehicle', 'route'])->limit(10)->get();
    }

    /**
     * Clear all caches
     */
    public function clearAllCaches()
    {
        $cacheKeys = [
            'dashboard_stats_optimized',
            'recent_trips_optimized',
            'active_trips_optimized',
            'avg_trip_duration',
            'on_time_percentage',
            'popular_route',
            'student_trend',
            'vehicle_trend',
            'driver_trend',
            'trip_trend',
            'vehicle_utilization_optimized',
        ];

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }

        // Clear pattern-based caches
        $patterns = [
            'students_list_*',
            'guardians_list_*',
            'vehicles_list_*',
            'drivers_list_*',
            'routes_list_*',
            'trips_list_*',
            'schools_list_*',
            'chart_data_*',
        ];

        foreach ($patterns as $pattern) {
            $this->clearCachePattern($pattern);
        }

        return true;
    }

    /**
     * Clear cache pattern (simplified version)
     */
    private function clearCachePattern($pattern)
    {
        // This is a simplified version - in production you'd use Redis SCAN
        $keys = [
            'students_list_',
            'guardians_list_',
            'vehicles_list_',
            'drivers_list_',
            'routes_list_',
            'trips_list_',
            'schools_list_',
            'chart_data_',
        ];

        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }

    /**
     * Get performance metrics
     */
    public function getPerformanceMetrics()
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        // Test database performance
        $dbStart = microtime(true);
        $studentCount = \App\Models\Student::count();
        $vehicleCount = \App\Models\Vehicle::count();
        $tripCount = \App\Models\Trip::count();
        $dbTime = round((microtime(true) - $dbStart) * 1000, 2);

        // Test cache performance
        $cacheStart = microtime(true);
        Cache::remember('performance_test', 60, function() {
            return ['test' => 'data'];
        });
        $cacheTime = round((microtime(true) - $cacheStart) * 1000, 2);

        $endTime = microtime(true);
        $endMemory = memory_get_usage();

        return [
            'execution_time' => round(($endTime - $startTime) * 1000, 2) . 'ms',
            'memory_usage' => round(($endMemory - $startMemory) / 1024 / 1024, 2) . 'MB',
            'database_time' => $dbTime . 'ms',
            'cache_time' => $cacheTime . 'ms',
            'student_count' => $studentCount,
            'vehicle_count' => $vehicleCount,
            'trip_count' => $tripCount,
        ];
    }

    /**
     * Optimize database connections
     */
    public function optimizeDatabaseConnections()
    {
        $config = config('database.connections.mysql');
        
        return [
            'max_connections' => $config['options'][PDO::ATTR_PERSISTENT] ?? 'Not set',
            'timeout' => $config['options'][PDO::ATTR_TIMEOUT] ?? 'Not set',
            'charset' => $config['charset'] ?? 'Not set',
        ];
    }

    /**
     * Get cache statistics
     */
    public function getCacheStatistics()
    {
        $stats = [
            'cache_driver' => config('cache.default'),
            'cache_prefix' => config('cache.prefix'),
        ];

        // Test cache operations
        $testKey = 'cache_test_' . time();
        $testValue = 'test_value_' . time();

        $start = microtime(true);
        Cache::put($testKey, $testValue, 60);
        $writeTime = round((microtime(true) - $start) * 1000, 2);

        $start = microtime(true);
        $retrieved = Cache::get($testKey);
        $readTime = round((microtime(true) - $start) * 1000, 2);

        Cache::forget($testKey);

        return array_merge($stats, [
            'write_time' => $writeTime . 'ms',
            'read_time' => $readTime . 'ms',
            'test_successful' => $retrieved === $testValue,
        ]);
    }
}