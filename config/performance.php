<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Performance Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains performance-related configuration options
    | for the school vehicle management system.
    |
    */

    'cache' => [
        /*
        |--------------------------------------------------------------------------
        | Cache TTL (Time To Live) Settings
        |--------------------------------------------------------------------------
        |
        | Configure cache expiration times for different types of data.
        | All values are in seconds.
        |
        */
        'ttl' => [
            'dashboard_stats' => env('CACHE_DASHBOARD_STATS_TTL', 300), // 5 minutes
            'recent_trips' => env('CACHE_RECENT_TRIPS_TTL', 180), // 3 minutes
            'active_trips' => env('CACHE_ACTIVE_TRIPS_TTL', 60), // 1 minute
            'student_lists' => env('CACHE_STUDENT_LISTS_TTL', 300), // 5 minutes
            'vehicle_lists' => env('CACHE_VEHICLE_LISTS_TTL', 300), // 5 minutes
            'driver_lists' => env('CACHE_DRIVER_LISTS_TTL', 300), // 5 minutes
            'route_lists' => env('CACHE_ROUTE_LISTS_TTL', 300), // 5 minutes
            'trip_lists' => env('CACHE_TRIP_LISTS_TTL', 180), // 3 minutes
            'guardian_lists' => env('CACHE_GUARDIAN_LISTS_TTL', 300), // 5 minutes
            'school_lists' => env('CACHE_SCHOOL_LISTS_TTL', 600), // 10 minutes
            'chart_data' => env('CACHE_CHART_DATA_TTL', 300), // 5 minutes
            'trends' => env('CACHE_TRENDS_TTL', 300), // 5 minutes
        ],
    ],

    'database' => [
        /*
        |--------------------------------------------------------------------------
        | Database Optimization Settings
        |--------------------------------------------------------------------------
        |
        | Configure database-related performance optimizations.
        |
        */
        'optimization' => [
            'enable_query_logging' => env('DB_ENABLE_QUERY_LOGGING', false),
            'slow_query_threshold' => env('DB_SLOW_QUERY_THRESHOLD', 100), // milliseconds
            'max_connections' => env('DB_MAX_CONNECTIONS', 100),
            'connection_timeout' => env('DB_CONNECTION_TIMEOUT', 30), // seconds
        ],
    ],

    'assets' => [
        /*
        |--------------------------------------------------------------------------
        | Asset Optimization Settings
        |--------------------------------------------------------------------------
        |
        | Configure asset optimization and CDN settings.
        |
        */
        'optimization' => [
            'enable_minification' => env('ASSETS_ENABLE_MINIFICATION', true),
            'enable_compression' => env('ASSETS_ENABLE_COMPRESSION', true),
            'enable_cdn' => env('ASSETS_ENABLE_CDN', false),
            'cdn_url' => env('ASSETS_CDN_URL', ''),
        ],
    ],

    'pagination' => [
        /*
        |--------------------------------------------------------------------------
        | Pagination Settings
        |--------------------------------------------------------------------------
        |
        | Configure pagination settings for different modules.
        |
        */
        'default_per_page' => env('PAGINATION_DEFAULT_PER_PAGE', 10),
        'max_per_page' => env('PAGINATION_MAX_PER_PAGE', 100),
        'per_page_options' => [10, 25, 50, 100],
    ],

    'monitoring' => [
        /*
        |--------------------------------------------------------------------------
        | Performance Monitoring Settings
        |--------------------------------------------------------------------------
        |
        | Configure performance monitoring and alerting.
        |
        */
        'enable_monitoring' => env('PERFORMANCE_MONITORING_ENABLED', true),
        'slow_request_threshold' => env('PERFORMANCE_SLOW_REQUEST_THRESHOLD', 2000), // milliseconds
        'memory_limit_threshold' => env('PERFORMANCE_MEMORY_LIMIT_THRESHOLD', 128), // MB
        'enable_query_profiling' => env('PERFORMANCE_ENABLE_QUERY_PROFILING', false),
    ],

    'caching' => [
        /*
        |--------------------------------------------------------------------------
        | Caching Strategy Settings
        |--------------------------------------------------------------------------
        |
        | Configure caching strategies for different types of data.
        |
        */
        'strategy' => [
            'dashboard' => 'aggressive', // aggressive, moderate, conservative
            'lists' => 'moderate',
            'charts' => 'aggressive',
            'reports' => 'conservative',
        ],
    ],
];
