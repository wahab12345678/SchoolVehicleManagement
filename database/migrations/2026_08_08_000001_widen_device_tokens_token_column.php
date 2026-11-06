<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
<<<<<<< HEAD
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE device_tokens MODIFY token VARCHAR(512) NOT NULL');
        }
=======
        DB::statement('ALTER TABLE device_tokens MODIFY token VARCHAR(512) NOT NULL');
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
    }

    public function down(): void
    {
<<<<<<< HEAD
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE device_tokens MODIFY token VARCHAR(255) NOT NULL');
        }
=======
        DB::statement('ALTER TABLE device_tokens MODIFY token VARCHAR(255) NOT NULL');
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
    }
};
