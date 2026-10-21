<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('loan_settings', function (Blueprint $table) {
            $table->decimal('min_amount', 12, 2)->default(100.00)->after('annual_rate');
            $table->decimal('max_amount', 12, 2)->default(100000.00)->after('min_amount');
        });

        DB::table('loan_settings')->update([
            'min_amount' => 100.00,
            'max_amount' => 100000.00,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loan_settings', function (Blueprint $table) {
            $table->dropColumn(['min_amount', 'max_amount']);
        });
    }
};
