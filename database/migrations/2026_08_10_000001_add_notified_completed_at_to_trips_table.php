<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            if (!Schema::hasColumn('trips', 'notified_completed_at')) {
                $table->timestamp('notified_completed_at')->nullable()->after('notified_boarded_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            if (Schema::hasColumn('trips', 'notified_completed_at')) {
                $table->dropColumn('notified_completed_at');
            }
        });
    }
};
