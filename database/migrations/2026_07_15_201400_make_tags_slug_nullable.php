<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Modify the `slug` column to allow NULL values. Using raw SQL to avoid doctrine/dbal dependency.
        DB::statement('ALTER TABLE `tags` MODIFY `slug` JSON NULL;');
    }

    public function down(): void
    {
        // Revert to NOT NULL (this may fail if NULL values exist). Use with caution.
        DB::statement('ALTER TABLE `tags` MODIFY `slug` JSON NOT NULL;');
    }
};
