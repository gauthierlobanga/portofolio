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
        Schema::create('user_project_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('module_project_id')->constrained('module_projects')->cascadeOnDelete();
            $table->string('status')->default('pending'); // pending, submitted, graded
            $table->string('grade')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'module_project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_project_submissions');
    }
};
