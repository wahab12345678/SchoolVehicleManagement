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
        Schema::table('vehicles', function (Blueprint $table) {
            // First drop the foreign key constraint
            $table->dropForeign(['driver_id']);
            
            // Make the column nullable
            $table->foreignId('driver_id')->nullable()->change();
            
            // Re-add the foreign key constraint with nullable
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['driver_id']);
            
            // Make the column not nullable again
            $table->foreignId('driver_id')->nullable(false)->change();
            
            // Re-add the original foreign key constraint
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
