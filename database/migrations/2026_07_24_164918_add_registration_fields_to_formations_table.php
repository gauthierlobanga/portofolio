<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formations', function (Blueprint $table): void {
            $table->string('delivery_mode', 20)->nullable()->after('location');
            $table->decimal('price', 10, 2)->nullable()->after('duration');
            $table->char('currency', 3)->default('EUR')->after('price');
            $table->unsignedInteger('capacity')->nullable()->after('currency');
            $table->date('registration_deadline')->nullable()->after('capacity');
            $table->text('online_url')->nullable()->after('registration_deadline');
            $table->text('payment_instructions')->nullable()->after('online_url');

            $table->index(['delivery_mode', 'is_active']);
            $table->index('registration_deadline');
        });
    }

    public function down(): void
    {
        Schema::table('formations', function (Blueprint $table): void {
            $table->dropIndex(['delivery_mode', 'is_active']);
            $table->dropIndex(['registration_deadline']);
            $table->dropColumn([
                'delivery_mode',
                'price',
                'currency',
                'capacity',
                'registration_deadline',
                'online_url',
                'payment_instructions',
            ]);
        });
    }
};
