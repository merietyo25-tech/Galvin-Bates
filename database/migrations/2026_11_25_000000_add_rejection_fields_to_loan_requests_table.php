<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loan_requests', function (Blueprint $table) {
            if (! Schema::hasColumn('loan_requests', 'rejected_at')) {
                $table->timestamp('rejected_at')->nullable();
            }
            if (! Schema::hasColumn('loan_requests', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('loan_requests', function (Blueprint $table) {
            if (Schema::hasColumn('loan_requests', 'rejection_reason')) {
                $table->dropColumn('rejection_reason');
            }
            if (Schema::hasColumn('loan_requests', 'rejected_at')) {
                $table->dropColumn('rejected_at');
            }
        });
    }
};
