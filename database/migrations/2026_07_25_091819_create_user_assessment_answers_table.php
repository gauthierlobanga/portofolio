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
        Schema::create('user_assessment_answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_assessment_attempt_id')->constrained('user_assessment_attempts', 'id', 'uaa_attempt_fk')->cascadeOnDelete();
            $table->foreignUuid('assessment_question_id')->constrained('assessment_questions', 'id', 'uaa_question_fk')->cascadeOnDelete();
            $table->text('answer_text')->nullable();
            $table->string('file_path')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->decimal('points_awarded', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_assessment_answers');
    }
};
