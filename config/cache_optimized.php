<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    */

    'default' => env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    */

    'stores' => [
        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'cache',
            'connection' => null,
            'lock_connection' => null,
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
            'lock_connection' => 'default',
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => env('DYNAMODB_ENDPOINT'),
        ],

        'octane' => [
            'driver' => 'octane',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing a RAM based store such as APC or Memcached, there might
    | be other applications utilizing the same cache. So, we'll specify a
    | value to get prefixed to all our keys so we can avoid collisions.
    |
    */

    'prefix' => env('CACHE_PREFIX', 'school_management_cache'),

    /*
    |--------------------------------------------------------------------------
    | Performance Optimized Cache Settings
    |--------------------------------------------------------------------------
    |
    | These settings are optimized for better performance in the school
    | vehicle management system.
    |
    */

    'performance' => [
        'dashboard_stats_ttl' => env('CACHE_DASHBOARD_STATS_TTL', 300),
        'recent_trips_ttl' => env('CACHE_RECENT_TRIPS_TTL', 180),
        'active_trips_ttl' => env('CACHE_ACTIVE_TRIPS_TTL', 60),
        'student_lists_ttl' => env('CACHE_STUDENT_LISTS_TTL', 300),
        'vehicle_lists_ttl' => env('CACHE_VEHICLE_LISTS_TTL', 300),
        'driver_lists_ttl' => env('CACHE_DRIVER_LISTS_TTL', 300),
        'route_lists_ttl' => env('CACHE_ROUTE_LISTS_TTL', 300),
        'trip_lists_ttl' => env('CACHE_TRIP_LISTS_TTL', 180),
        'guardian_lists_ttl' => env('CACHE_GUARDIAN_LISTS_TTL', 300),
        'school_lists_ttl' => env('CACHE_SCHOOL_LISTS_TTL', 600),
        'chart_data_ttl' => env('CACHE_CHART_DATA_TTL', 300),
        'trends_ttl' => env('CACHE_TRENDS_TTL', 300),
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Tags
    |--------------------------------------------------------------------------
    |
    | Define cache tags for better cache management and invalidation.
    |
    */

    'tags' => [
        'dashboard' => ['dashboard_stats', 'recent_trips', 'active_trips'],
        'students' => ['student_lists', 'student_classes'],
        'vehicles' => ['vehicle_lists', 'vehicle_utilization'],
        'drivers' => ['driver_lists'],
        'routes' => ['route_lists'],
        'trips' => ['trip_lists', 'trip_trends'],
        'guardians' => ['guardian_lists'],
        'schools' => ['school_lists'],
        'charts' => ['chart_data', 'trends'],
    ],
];
