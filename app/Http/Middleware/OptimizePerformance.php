<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OptimizePerformance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Start performance monitoring
        $startTime = microtime(true);
        $startMemory = memory_get_usage();
        
        // Enable query logging for admin routes
        if ($request->is('admin/*') && app()->environment('local')) {
            DB::enableQueryLog();
        }

        $response = $next($request);

        // Log performance metrics
        $this->logPerformanceMetrics($request, $startTime, $startMemory);

        // Add performance headers
        $this->addPerformanceHeaders($response, $startTime, $startMemory);

        return $response;
    }

    /**
     * Log performance metrics
     */
    private function logPerformanceMetrics(Request $request, $startTime, $startMemory)
    {
        $endTime = microtime(true);
        $endMemory = memory_get_usage();
        
        $executionTime = round(($endTime - $startTime) * 1000, 2);
        $memoryUsage = round(($endMemory - $startMemory) / 1024 / 1024, 2);
        
        // Log slow requests
        if ($executionTime > 2000) { // More than 2 seconds
            Log::warning('Slow request detected', [
                'url' => $request->url(),
                'method' => $request->method(),
                'execution_time' => $executionTime . 'ms',
                'memory_usage' => $memoryUsage . 'MB',
                'user_agent' => $request->userAgent(),
                'ip' => $request->ip(),
            ]);
        }
        
        // Log high memory usage
        if ($memoryUsage > 64) { // More than 64MB
            Log::warning('High memory usage detected', [
                'url' => $request->url(),
                'memory_usage' => $memoryUsage . 'MB',
                'execution_time' => $executionTime . 'ms',
            ]);
        }
        
        // Log query performance for admin routes
        if ($request->is('admin/*') && app()->environment('local')) {
            $queries = DB::getQueryLog();
            $slowQueries = array_filter($queries, function($query) {
                return $query['time'] > 100; // More than 100ms
            });
            
            if (!empty($slowQueries)) {
                Log::warning('Slow queries detected', [
                    'url' => $request->url(),
                    'slow_queries' => $slowQueries,
                    'total_queries' => count($queries),
                ]);
            }
        }
    }

    /**
     * Add performance headers
     */
    private function addPerformanceHeaders($response, $startTime, $startMemory)
    {
        $endTime = microtime(true);
        $endMemory = memory_get_usage();
        
        $executionTime = round(($endTime - $startTime) * 1000, 2);
        $memoryUsage = round(($endMemory - $startMemory) / 1024 / 1024, 2);
        
        $response->headers->set('X-Execution-Time', $executionTime . 'ms');
        $response->headers->set('X-Memory-Usage', $memoryUsage . 'MB');
        $response->headers->set('X-Cache-Status', $this->getCacheStatus());
        
        return $response;
    }

    /**
     * Get cache status
     */
    private function getCacheStatus()
    {
        try {
            $testKey = 'performance_test_' . time();
            Cache::put($testKey, 'test', 1);
            $result = Cache::get($testKey);
            Cache::forget($testKey);
            
            return $result ? 'enabled' : 'disabled';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
