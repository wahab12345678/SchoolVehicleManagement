<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Widen status for Careem-style pickup flow
        DB::statement("ALTER TABLE trips MODIFY COLUMN status ENUM('pending', 'en_route', 'arrived', 'in_progress', 'completed') NOT NULL DEFAULT 'pending'");

        Schema::table('trips', function (Blueprint $table) {
            $table->enum('direction', ['to_school', 'from_school'])->default('to_school')->after('status');
            $table->timestamp('pickup_started_at')->nullable()->after('started_at'); // driver on the way
            $table->timestamp('arrived_at')->nullable()->after('pickup_started_at'); // outside house
            $table->timestamp('boarded_at')->nullable()->after('arrived_at');       // child boarded / live track
            $table->timestamp('notified_pickup_at')->nullable()->after('ended_at');
            $table->timestamp('notified_arrived_at')->nullable()->after('notified_pickup_at');
            $table->timestamp('notified_boarded_at')->nullable()->after('notified_arrived_at');
        });
    }

    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn([
                'direction',
                'pickup_started_at',
                'arrived_at',
                'boarded_at',
                'notified_pickup_at',
                'notified_arrived_at',
                'notified_boarded_at',
            ]);
        });

        // Collapse any new statuses before shrinking enum
        DB::table('trips')->whereIn('status', ['en_route', 'arrived'])->update(['status' => 'pending']);
        DB::statement("ALTER TABLE trips MODIFY COLUMN status ENUM('pending', 'in_progress', 'completed') NOT NULL");
    }
};
