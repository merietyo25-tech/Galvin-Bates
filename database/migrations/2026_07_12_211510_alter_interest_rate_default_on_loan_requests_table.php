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
        DB::statement('ALTER TABLE loan_requests MODIFY interest_rate DECIMAL(5,2) NOT NULL DEFAULT 2.00');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE loan_requests MODIFY interest_rate DECIMAL(5,2) NOT NULL DEFAULT 5.00');
    }
};
