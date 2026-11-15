<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add composite indexes for better query performance
        try {
            // Students table composite indexes
            if (Schema::hasTable('students')) {
                Schema::table('students', function (Blueprint $table) {
                    // Add composite index for common queries
                    if (!$this->indexExists('students', 'idx_students_parent_school')) {
                        $table->index(['parent_id', 'school_id'], 'idx_students_parent_school');
                    }
                });
            }

            // Trips table composite indexes
            if (Schema::hasTable('trips')) {
                Schema::table('trips', function (Blueprint $table) {
                    // Add composite index for status and date queries
                    if (!$this->indexExists('trips', 'idx_trips_status_date')) {
                        $table->index(['status', 'created_at'], 'idx_trips_status_date');
                    }
                    
                    // Add composite index for vehicle and status queries
                    if (!$this->indexExists('trips', 'idx_trips_vehicle_status')) {
                        $table->index(['vehicle_id', 'status'], 'idx_trips_vehicle_status');
                    }
                });
            }

            // Vehicles table composite indexes
            if (Schema::hasTable('vehicles')) {
                Schema::table('vehicles', function (Blueprint $table) {
                    // Add composite index for driver and availability queries
                    if (!$this->indexExists('vehicles', 'idx_vehicles_driver_available')) {
                        $table->index(['driver_id', 'is_available'], 'idx_vehicles_driver_available');
                    }
                });
            }

        } catch (\Exception $e) {
            // Log the error but don't fail the migration
            \Log::warning('Performance index migration error: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            // Drop composite indexes
            if (Schema::hasTable('students')) {
                Schema::table('students', function (Blueprint $table) {
                    $table->dropIndex('idx_students_parent_school');
                });
            }

            if (Schema::hasTable('trips')) {
                Schema::table('trips', function (Blueprint $table) {
                    $table->dropIndex('idx_trips_status_date');
                    $table->dropIndex('idx_trips_vehicle_status');
                });
            }

            if (Schema::hasTable('vehicles')) {
                Schema::table('vehicles', function (Blueprint $table) {
                    $table->dropIndex('idx_vehicles_driver_available');
                });
            }

        } catch (\Exception $e) {
            \Log::warning('Performance index rollback error: ' . $e->getMessage());
        }
    }

    /**
     * Check if index exists
     */
    private function indexExists($table, $indexName)
    {
        try {
            $indexes = DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName]);
            return count($indexes) > 0;
        } catch (\Exception $e) {
            return false;
        }
    }
};
