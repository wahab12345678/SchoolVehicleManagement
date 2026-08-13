<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->time('start_time')->nullable()->after('is_active'); // e.g. 08:00:00
            $table->time('end_time')->nullable()->after('start_time');   // e.g. 14:00:00
            $table->string('timezone', 64)->default('Asia/Karachi')->after('end_time');
            $table->unsignedSmallInteger('pickup_lead_minutes')->default(45)->after('timezone');
        });
    }

    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time', 'timezone', 'pickup_lead_minutes']);
        });
    }
};
