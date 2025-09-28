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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Use roll_number to match model and views (was registration_no)
            $table->string('roll_number')->unique();
            // Class column (nullable) used in views as $student->class
            $table->string('class')->nullable();
            $table->foreignId('parent_id')->constrained('guardians')->onDelete('cascade'); // parent is a guardian
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
