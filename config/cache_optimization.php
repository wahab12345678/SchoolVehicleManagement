<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cache Optimization Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains cache optimization settings for better performance
    |
    */

    'dashboard' => [
        'stats_cache_time' => 300, // 5 minutes
        'recent_trips_cache_time' => 300, // 5 minutes
        'active_trips_cache_time' => 60, // 1 minute
        'chart_data_cache_time' => 300, // 5 minutes
    ],

    'modules' => [
        'students_cache_time' => 600, // 10 minutes
        'guardians_cache_time' => 600, // 10 minutes
        'vehicles_cache_time' => 300, // 5 minutes
        'drivers_cache_time' => 600, // 10 minutes
        'routes_cache_time' => 900, // 15 minutes
        'trips_cache_time' => 300, // 5 minutes
    ],

    'real_time' => [
        'trip_locations_cache_time' => 30, // 30 seconds
        'active_trips_cache_time' => 30, // 30 seconds
        'vehicle_status_cache_time' => 60, // 1 minute
    ],

    'cache_keys' => [
        'dashboard_stats' => 'dashboard_stats',
        'dashboard_recent_trips' => 'dashboard_recent_trips',
        'dashboard_active_trips' => 'dashboard_active_trips',
        'chart_data' => 'chart_data_',
        'students_list' => 'students_list',
        'guardians_list' => 'guardians_list',
        'vehicles_list' => 'vehicles_list',
        'drivers_list' => 'drivers_list',
        'routes_list' => 'routes_list',
        'trips_list' => 'trips_list',
    ],

    'cache_tags' => [
        'dashboard' => ['dashboard'],
        'students' => ['students', 'dashboard'],
        'guardians' => ['guardians', 'dashboard'],
        'vehicles' => ['vehicles', 'dashboard'],
        'drivers' => ['drivers', 'dashboard'],
        'routes' => ['routes', 'dashboard'],
        'trips' => ['trips', 'dashboard'],
    ],
];
