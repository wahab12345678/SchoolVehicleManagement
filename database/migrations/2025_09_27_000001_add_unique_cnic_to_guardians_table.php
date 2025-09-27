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
        // Add unique index on cnic if column exists. Use try/catch to remain compatible
        // with different DB drivers and avoid Doctrine dependency.
        if (Schema::hasColumn('guardians', 'cnic')) {
            try {
                Schema::table('guardians', function (Blueprint $table) {
                    $table->unique('cnic');
                });
            } catch (\Exception $e) {
                // Index may already exist or DB doesn't support the operation as-is; ignore.
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::table('guardians', function (Blueprint $table) {
                $table->dropUnique('guardians_cnic_unique');
            });
        } catch (\Exception $e) {
            // Ignore errors if index doesn't exist or DB driver reports differently
        }
    }
};
