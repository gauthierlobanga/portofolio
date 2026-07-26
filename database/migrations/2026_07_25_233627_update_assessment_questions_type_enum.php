<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("ALTER TABLE `assessment_questions` MODIFY COLUMN `type` ENUM('multiple_choice', 'text', 'code_editor', 'qcm', 'code') NOT NULL DEFAULT 'text';");

        DB::table('assessment_questions')
            ->where('type', 'qcm')
            ->update(['type' => 'multiple_choice']);

        DB::table('assessment_questions')
            ->where('type', 'code')
            ->update(['type' => 'code_editor']);

        DB::statement("ALTER TABLE `assessment_questions` MODIFY COLUMN `type` ENUM('multiple_choice', 'text', 'code_editor') NOT NULL DEFAULT 'text';");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::table('assessment_questions')
            ->where('type', 'qcm')
            ->update(['type' => 'multiple_choice']);

        DB::table('assessment_questions')
            ->where('type', 'code')
            ->update(['type' => 'code_editor']);

        DB::statement("ALTER TABLE `assessment_questions` MODIFY COLUMN `type` ENUM('multiple_choice', 'text', 'code_editor') NOT NULL DEFAULT 'text';");
    }
};
