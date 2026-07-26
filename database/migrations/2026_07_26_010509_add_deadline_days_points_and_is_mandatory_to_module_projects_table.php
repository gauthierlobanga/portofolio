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
        Schema::table('module_projects', function (Blueprint $table) {
            $table->integer('deadline_days')->default(7)->after('description');
            $table->integer('points')->default(100)->after('deadline_days');
            $table->boolean('is_mandatory')->default(true)->after('points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('module_projects', function (Blueprint $table) {
            $table->dropColumn(['deadline_days', 'points', 'is_mandatory']);
        });
    }
};
