<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formation_registrations', function (Blueprint $table): void {
            $table->decimal('amount', 10, 2)->nullable()->after('payment_status');
            $table->char('currency', 3)->default('EUR')->after('amount');
            $table->string('payment_reference')->nullable()->after('currency');
            $table->string('attendance_status')->default('registered')->after('payment_reference');
            $table->timestamp('terms_accepted_at')->nullable()->after('attendance_status');
            $table->timestamp('approved_at')->nullable()->after('terms_accepted_at');
            $table->timestamp('cancelled_at')->nullable()->after('approved_at');
            $table->text('admin_notes')->nullable()->after('cancelled_at');

            $table->unique(['formation_id', 'user_id']);
            $table->index(['formation_id', 'status']);
            $table->index(['payment_status', 'created_at']);
            $table->index('attendance_status');
        });
    }

    public function down(): void
    {
        Schema::table('formation_registrations', function (Blueprint $table): void {
            $table->dropUnique(['formation_id', 'user_id']);
            $table->dropIndex(['formation_id', 'status']);
            $table->dropIndex(['payment_status', 'created_at']);
            $table->dropIndex(['attendance_status']);
            $table->dropColumn([
                'amount',
                'currency',
                'payment_reference',
                'attendance_status',
                'terms_accepted_at',
                'approved_at',
                'cancelled_at',
                'admin_notes',
            ]);
        });
    }
};
