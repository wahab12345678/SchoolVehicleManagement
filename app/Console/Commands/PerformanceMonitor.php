<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PerformanceOptimizationService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PerformanceMonitor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'performance:monitor 
                            {--clear-cache : Clear all caches}
                            {--optimize : Run optimization routines}
                            {--metrics : Show performance metrics}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor and optimize application performance';

    protected $performanceService;

    public function __construct(PerformanceOptimizationService $performanceService)
    {
        parent::__construct();
        $this->performanceService = $performanceService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Performance Monitor Starting...');
        $this->newLine();

        if ($this->option('clear-cache')) {
            $this->clearCaches();
        }

        if ($this->option('optimize')) {
            $this->runOptimization();
        }

        if ($this->option('metrics')) {
            $this->showMetrics();
        }

        if (!$this->option('clear-cache') && !$this->option('optimize') && !$this->option('metrics')) {
            $this->showAll();
        }

        $this->newLine();
        $this->info('✅ Performance monitoring completed!');
    }

    /**
     * Clear all caches
     */
    private function clearCaches()
    {
        $this->info('🧹 Clearing all caches...');
        
        $this->performanceService->clearAllCaches();
        
        $this->info('✅ All caches cleared successfully!');
    }

    /**
     * Run optimization routines
     */
    private function runOptimization()
    {
        $this->info('⚡ Running optimization routines...');
        
        $queryResults = $this->performanceService->optimizeQueries();
        
        $this->table(['Metric', 'Value'], [
            ['Total Queries', $queryResults['total_queries']],
            ['Slow Queries', $queryResults['slow_queries']],
            ['Optimization Status', $queryResults['slow_queries'] > 0 ? '⚠️ Needs Attention' : '✅ Good'],
        ]);
    }

    /**
     * Show performance metrics
     */
    private function showMetrics()
    {
        $this->info('📊 Performance Metrics:');
        
        $metrics = $this->performanceService->getPerformanceMetrics();
        $cacheStats = $this->performanceService->getCacheStatistics();
        
        $this->table(['Metric', 'Value'], [
            ['Execution Time', $metrics['execution_time']],
            ['Memory Usage', $metrics['memory_usage']],
            ['Database Time', $metrics['database_time']],
            ['Cache Time', $metrics['cache_time']],
            ['Students Count', $metrics['student_count']],
            ['Vehicles Count', $metrics['vehicle_count']],
            ['Trips Count', $metrics['trip_count']],
        ]);

        $this->newLine();
        $this->info('💾 Cache Statistics:');
        
        $this->table(['Metric', 'Value'], [
            ['Cache Driver', $cacheStats['cache_driver']],
            ['Cache Prefix', $cacheStats['cache_prefix']],
            ['Write Time', $cacheStats['write_time']],
            ['Read Time', $cacheStats['read_time']],
            ['Test Successful', $cacheStats['test_successful'] ? '✅ Yes' : '❌ No'],
        ]);
    }

    /**
     * Show all information
     */
    private function showAll()
    {
        $this->showMetrics();
        $this->newLine();
        $this->runOptimization();
    }
}
