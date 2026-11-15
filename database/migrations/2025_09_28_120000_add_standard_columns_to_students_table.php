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
        if (!Schema::hasTable('students')) {
            return;
        }

        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'roll_number')) {
                // Add as nullable to avoid issues on existing rows
                $table->string('roll_number')->nullable()->after('name');
            }

            if (!Schema::hasColumn('students', 'class')) {
                $table->string('class')->nullable()->after('roll_number');
            }
        });

        // If we have a legacy registration_no column, copy its values into roll_number when roll_number is empty
        if (Schema::hasColumn('students', 'registration_no') && Schema::hasColumn('students', 'roll_number')) {
            DB::statement("UPDATE students SET roll_number = registration_no WHERE (roll_number IS NULL OR roll_number = '') AND (registration_no IS NOT NULL AND registration_no <> '')");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('students')) {
            return;
        }

        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'roll_number')) {
                $table->dropColumn('roll_number');
            }
            if (Schema::hasColumn('students', 'class')) {
                $table->dropColumn('class');
            }
        });
    }
};
