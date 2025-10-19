<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PerformanceOptimization
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
        // Start query logging for development
        if (app()->environment('local')) {
            DB::enableQueryLog();
        }

        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $response = $next($request);

        // Log performance metrics in development
        if (app()->environment('local')) {
            $endTime = microtime(true);
            $endMemory = memory_get_usage();
            
            $executionTime = round(($endTime - $startTime) * 1000, 2);
            $memoryUsage = round(($endMemory - $startMemory) / 1024 / 1024, 2);
            
            $queries = DB::getQueryLog();
            $queryCount = count($queries);
            
            // Log slow queries (> 100ms)
            $slowQueries = array_filter($queries, function($query) {
                return $query['time'] > 100;
            });
            
            if (!empty($slowQueries)) {
                \Log::warning('Slow queries detected', [
                    'url' => $request->url(),
                    'queries' => $slowQueries
                ]);
            }
            
            // Log performance metrics
            \Log::info('Performance metrics', [
                'url' => $request->url(),
                'execution_time' => $executionTime . 'ms',
                'memory_usage' => $memoryUsage . 'MB',
                'query_count' => $queryCount,
                'slow_queries' => count($slowQueries)
            ]);
        }

        return $response;
    }
}
