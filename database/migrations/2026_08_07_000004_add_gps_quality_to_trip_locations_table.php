<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trip_locations', function (Blueprint $table) {
            $table->decimal('accuracy', 8, 2)->nullable()->after('longitude'); // meters
            $table->decimal('heading', 6, 2)->nullable()->after('accuracy');   // degrees
            $table->decimal('speed', 8, 2)->nullable()->after('heading');      // from device
        });

        $indexExists = collect(
            DB::select("SHOW INDEX FROM trip_locations WHERE Key_name = 'trip_locations_trip_id_recorded_at_index'")
        )->isNotEmpty();

        if (!$indexExists) {
            Schema::table('trip_locations', function (Blueprint $table) {
                $table->index(['trip_id', 'recorded_at']);
            });
        }
    }

    public function down(): void
    {
        $indexExists = collect(
            DB::select("SHOW INDEX FROM trip_locations WHERE Key_name = 'trip_locations_trip_id_recorded_at_index'")
        )->isNotEmpty();

        if ($indexExists) {
            Schema::table('trip_locations', function (Blueprint $table) {
                $table->dropIndex(['trip_id', 'recorded_at']);
            });
        }

        Schema::table('trip_locations', function (Blueprint $table) {
            $table->dropColumn(['accuracy', 'heading', 'speed']);
        });
    }
};
