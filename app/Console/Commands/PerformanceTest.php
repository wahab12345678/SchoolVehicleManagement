<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class PerformanceTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'performance:test 
                            {--routes : Test route performance}
                            {--database : Test database performance}
                            {--cache : Test cache performance}
                            {--all : Run all performance tests}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run performance tests for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting Performance Tests...');
        $this->newLine();

        $testRoutes = $this->option('routes') || $this->option('all');
        $testDatabase = $this->option('database') || $this->option('all');
        $testCache = $this->option('cache') || $this->option('all');

        if (!$testRoutes && !$testDatabase && !$testCache) {
            $testRoutes = $testDatabase = $testCache = true;
        }

        if ($testRoutes) {
            $this->testRoutes();
        }

        if ($testDatabase) {
            $this->testDatabase();
        }

        if ($testCache) {
            $this->testCache();
        }

        $this->newLine();
        $this->info('✅ Performance tests completed!');
    }

    /**
     * Test route performance
     */
    private function testRoutes()
    {
        $this->info('🔍 Testing Route Performance...');
        
        $routes = [
            'admin.dashboard' => '/admin/dashboard',
            'admin.students.index' => '/admin/students',
            'admin.guardians.index' => '/admin/guardians',
            'admin.vehicles.index' => '/admin/vehicles',
            'admin.drivers.index' => '/admin/drivers',
            'admin.routes.index' => '/admin/routes',
            'admin.trips.index' => '/admin/trips',
            'admin.school.index' => '/admin/school',
        ];

        $results = [];
        
        foreach ($routes as $name => $url) {
            $startTime = microtime(true);
            $startMemory = memory_get_usage();
            
            try {
                // Simulate route resolution
                $route = Route::getRoutes()->getByName($name);
                if ($route) {
                    $results[$name] = [
                        'status' => '✅',
                        'time' => round((microtime(true) - $startTime) * 1000, 2) . 'ms',
                        'memory' => round((memory_get_usage() - $startMemory) / 1024, 2) . 'KB'
                    ];
                } else {
                    $results[$name] = [
                        'status' => '❌',
                        'time' => 'N/A',
                        'memory' => 'N/A'
                    ];
                }
            } catch (\Exception $e) {
                $results[$name] = [
                    'status' => '❌',
                    'time' => 'Error',
                    'memory' => 'Error'
                ];
            }
        }

        $this->table(['Route', 'Status', 'Time', 'Memory'], 
            array_map(function($name, $result) {
                return [$name, $result['status'], $result['time'], $result['memory']];
            }, array_keys($results), $results)
        );
    }

    /**
     * Test database performance
     */
    private function testDatabase()
    {
        $this->info('🔍 Testing Database Performance...');
        
        $tests = [
            'Students Count' => function() {
                return \App\Models\Student::count();
            },
            'Guardians Count' => function() {
                return \App\Models\Guardian::count();
            },
            'Vehicles Count' => function() {
                return \App\Models\Vehicle::count();
            },
            'Trips Count' => function() {
                return \App\Models\Trip::count();
            },
            'Active Trips Count' => function() {
                return \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])->count();
            },
            'Students with Guardians' => function() {
                return \App\Models\Student::with('guardian')->get()->count();
            },
            'Trips with Relations' => function() {
                return \App\Models\Trip::with(['student', 'vehicle', 'route'])->limit(10)->get()->count();
            },
        ];

        $results = [];
        
        foreach ($tests as $name => $test) {
            $startTime = microtime(true);
            $startMemory = memory_get_usage();
            
            try {
                $result = $test();
                $executionTime = round((microtime(true) - $startTime) * 1000, 2);
                $memoryUsed = round((memory_get_usage() - $startMemory) / 1024, 2);
                
                $status = $executionTime < 100 ? '✅' : ($executionTime < 500 ? '⚠️' : '❌');
                
                $results[] = [
                    $name,
                    $status,
                    $executionTime . 'ms',
                    $memoryUsed . 'KB',
                    $result . ' records'
                ];
            } catch (\Exception $e) {
                $results[] = [
                    $name,
                    '❌',
                    'Error',
                    'Error',
                    $e->getMessage()
                ];
            }
        }

        $this->table(['Test', 'Status', 'Time', 'Memory', 'Result'], $results);
    }

    /**
     * Test cache performance
     */
    private function testCache()
    {
        $this->info('🔍 Testing Cache Performance...');
        
        $tests = [
            'Cache Write' => function() {
                $start = microtime(true);
                Cache::put('test_key', 'test_value', 60);
                return round((microtime(true) - $start) * 1000, 2);
            },
            'Cache Read' => function() {
                $start = microtime(true);
                $value = Cache::get('test_key');
                return round((microtime(true) - $start) * 1000, 2);
            },
            'Cache Delete' => function() {
                $start = microtime(true);
                Cache::forget('test_key');
                return round((microtime(true) - $start) * 1000, 2);
            },
            'Dashboard Stats Cache' => function() {
                $start = microtime(true);
                Cache::remember('dashboard_stats_test', 60, function() {
                    return [
                        'total_students' => \App\Models\Student::count(),
                        'total_vehicles' => \App\Models\Vehicle::count(),
                        'total_trips' => \App\Models\Trip::count(),
                    ];
                });
                return round((microtime(true) - $start) * 1000, 2);
            },
        ];

        $results = [];
        
        foreach ($tests as $name => $test) {
            try {
                $time = $test();
                $status = $time < 10 ? '✅' : ($time < 50 ? '⚠️' : '❌');
                
                $results[] = [
                    $name,
                    $status,
                    $time . 'ms'
                ];
            } catch (\Exception $e) {
                $results[] = [
                    $name,
                    '❌',
                    'Error: ' . $e->getMessage()
                ];
            }
        }

        $this->table(['Test', 'Status', 'Time'], $results);
    }
}
