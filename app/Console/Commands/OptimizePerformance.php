<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PerformanceOptimizationService;

class OptimizePerformance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:optimize {--production : Optimize for production environment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize system performance by clearing caches, warming up data, and optimizing database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting system optimization...');
        
        $optimizationService = new PerformanceOptimizationService();
        
        // Clear all caches
        $this->info('Clearing all caches...');
        $optimizationService->clearAllCaches();
        $this->info('✅ Caches cleared');
        
        // Optimize database
        $this->info('Optimizing database...');
        $optimizationService->optimizeDatabase();
        $this->info('✅ Database optimized');
        
        // Warm up caches
        $this->info('Warming up caches...');
        $optimizationService->warmUpCaches();
        $this->info('✅ Caches warmed up');
        
        // Production optimization
        if ($this->option('production')) {
            $this->info('Applying production optimizations...');
            $optimizationService->optimizeForProduction();
            $this->info('✅ Production optimizations applied');
        }
        
        // Display performance metrics
        $this->info('Performance Metrics:');
        $metrics = $optimizationService->getPerformanceMetrics();
        
        $this->table(
            ['Metric', 'Value'],
            [
                ['Database Size', $metrics['database_size'] . ' MB'],
                ['Cache Status', 'Optimized'],
                ['Cache Hit Ratio', $metrics['cache_hit_ratio']],
                ['Slow Queries', $metrics['slow_queries']],
            ]
        );
        
        $this->info('🎉 System optimization completed successfully!');
        
        return Command::SUCCESS;
    }
}
