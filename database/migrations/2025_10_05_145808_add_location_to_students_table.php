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
        Schema::table('students', function (Blueprint $table) {
            // store student location; nullable to keep backwards compatibility
            if (!Schema::hasColumn('students', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('parent_id');
            }
            if (!Schema::hasColumn('students', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }
            $table->index(['latitude', 'longitude'], 'students_lat_lng_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'latitude')) {
                $table->dropColumn('latitude');
            }
            if (Schema::hasColumn('students', 'longitude')) {
                $table->dropColumn('longitude');
            }
            if (Schema::hasIndex('students', 'students_lat_lng_index')) {
                // Laravel does not provide Schema::hasIndex, so wrap in try/catch to be safe
            }
        });
    }
};
