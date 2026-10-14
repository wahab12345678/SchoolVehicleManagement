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
        if (!Schema::hasTable('driver_service_areas')) {
            Schema::create('driver_service_areas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
                $table->string('area_name');
                $table->string('city')->default('Lahore');
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->index(['area_name', 'is_active']);
                $table->index(['driver_id', 'is_active']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_service_areas');
    }
};
