<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Table des catégories de compétences
        Schema::create('skill_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Modification de la table skills existante
        Schema::table('skills', function (Blueprint $table) {
            $table->foreignId('skill_category_id')->nullable()->after('category')->constrained('skill_categories')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->dropConstrainedForeignId('skill_category_id');
        });
        Schema::dropIfExists('skill_categories');
    }
};
