<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Clear caches when models are updated
        $this->registerModelCacheClearing();
        
        // Configure cache settings
        $this->configureCacheSettings();
    }

    /**
     * Register model cache clearing events
     */
    private function registerModelCacheClearing()
    {
        // Clear dashboard cache when students are updated
        Event::listen('eloquent.updated: App\Models\Student', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('students_list_*');
            Cache::forget('student_classes');
        });

        Event::listen('eloquent.created: App\Models\Student', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('students_list_*');
            Cache::forget('student_classes');
        });

        Event::listen('eloquent.deleted: App\Models\Student', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('students_list_*');
            Cache::forget('student_classes');
        });

        // Clear dashboard cache when trips are updated
        Event::listen('eloquent.updated: App\Models\Trip', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('recent_trips_optimized');
            Cache::forget('active_trips_optimized');
            Cache::forget('avg_trip_duration');
            Cache::forget('on_time_percentage');
            Cache::forget('trip_trend');
        });

        Event::listen('eloquent.created: App\Models\Trip', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('recent_trips_optimized');
            Cache::forget('active_trips_optimized');
            Cache::forget('trip_trend');
        });

        Event::listen('eloquent.deleted: App\Models\Trip', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('recent_trips_optimized');
            Cache::forget('active_trips_optimized');
            Cache::forget('trip_trend');
        });

        // Clear dashboard cache when vehicles are updated
        Event::listen('eloquent.updated: App\Models\Vehicle', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('vehicle_utilization_optimized');
            Cache::forget('vehicle_trend');
        });

        Event::listen('eloquent.created: App\Models\Vehicle', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('vehicle_utilization_optimized');
            Cache::forget('vehicle_trend');
        });

        Event::listen('eloquent.deleted: App\Models\Vehicle', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('vehicle_utilization_optimized');
            Cache::forget('vehicle_trend');
        });

        // Clear dashboard cache when drivers are updated
        Event::listen('eloquent.updated: App\Models\User', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('driver_trend');
        });

        Event::listen('eloquent.created: App\Models\User', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('driver_trend');
        });

        Event::listen('eloquent.deleted: App\Models\User', function () {
            Cache::forget('dashboard_stats_optimized');
            Cache::forget('driver_trend');
        });
    }

    /**
     * Configure cache settings
     */
    private function configureCacheSettings()
    {
        // Set cache tags for better cache management
        if (config('cache.default') === 'redis') {
            Cache::store('redis')->setPrefix('school_management:');
        }
    }
}
