<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('code_submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable()->index();
            $table->uuid('assessment_id')->nullable()->index();
            $table->uuid('assessment_question_id')->nullable()->index();
            $table->uuid('user_assessment_attempt_id')->nullable()->index();
            $table->longText('source_code');
            $table->string('language')->nullable();
            $table->longText('run_output')->nullable();
            $table->boolean('passed')->nullable();
            $table->json('test_results')->nullable();
            $table->string('judge0_token')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('code_submissions');
    }
};
