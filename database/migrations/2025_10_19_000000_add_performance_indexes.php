<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add indexes for better query performance
        
        // Students table indexes
        Schema::table('students', function (Blueprint $table) {
            $table->index(['school_id', 'created_at']);
            $table->index(['parent_id', 'created_at']);
            $table->index(['class', 'created_at']);
            $table->index('registration_no');
        });

        // Guardians table indexes
        Schema::table('guardians', function (Blueprint $table) {
            $table->index(['created_at']);
            $table->index('cnic');
        });

        // Vehicles table indexes
        Schema::table('vehicles', function (Blueprint $table) {
            $table->index(['is_available', 'status']);
            $table->index(['driver_id', 'is_available']);
            $table->index(['created_at']);
        });

        // Trips table indexes
        Schema::table('trips', function (Blueprint $table) {
            $table->index(['status', 'created_at']);
            $table->index(['student_id', 'status']);
            $table->index(['vehicle_id', 'status']);
            $table->index(['route_id', 'status']);
            $table->index(['started_at', 'ended_at']);
            $table->index(['created_at', 'status']);
        });

        // Routes table indexes
        Schema::table('routes', function (Blueprint $table) {
            $table->index(['created_at']);
        });

        // Trip locations table indexes
        Schema::table('trip_locations', function (Blueprint $table) {
            $table->index(['trip_id', 'created_at']);
            $table->index(['latitude', 'longitude']);
        });

        // Users table indexes for drivers
        Schema::table('users', function (Blueprint $table) {
            $table->index(['created_at']);
        });

        // Model has roles table indexes
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->index(['model_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove indexes
        Schema::table('students', function (Blueprint $table) {
            $table->dropIndex(['school_id', 'created_at']);
            $table->dropIndex(['parent_id', 'created_at']);
            $table->dropIndex(['class', 'created_at']);
            $table->dropIndex(['registration_no']);
        });

        Schema::table('guardians', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['cnic']);
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex(['is_available', 'status']);
            $table->dropIndex(['driver_id', 'is_available']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->dropIndex(['status', 'created_at']);
            $table->dropIndex(['student_id', 'status']);
            $table->dropIndex(['vehicle_id', 'status']);
            $table->dropIndex(['route_id', 'status']);
            $table->dropIndex(['started_at', 'ended_at']);
            $table->dropIndex(['created_at', 'status']);
        });

        Schema::table('routes', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });

        Schema::table('trip_locations', function (Blueprint $table) {
            $table->dropIndex(['trip_id', 'created_at']);
            $table->dropIndex(['latitude', 'longitude']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });

        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->dropIndex(['model_id', 'role_id']);
        });
    }
};
