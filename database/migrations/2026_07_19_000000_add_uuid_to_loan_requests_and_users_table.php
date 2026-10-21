<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id');
        });
        Schema::table('loan_requests', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id');
        });

        foreach (['users', 'loan_requests'] as $tableName) {
            DB::table($tableName)->whereNull('uuid')->orderBy('id')->select('id')->chunkById(500, function ($rows) use ($tableName) {
                foreach ($rows as $row) {
                    DB::table($tableName)->where('id', $row->id)->update(['uuid' => (string) Str::uuid()]);
                }
            });
        }

        Schema::table('users', function (Blueprint $table) {
            $table->unique('uuid');
        });
        Schema::table('loan_requests', function (Blueprint $table) {
            $table->unique('uuid');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['uuid']);
            $table->dropColumn('uuid');
        });
        Schema::table('loan_requests', function (Blueprint $table) {
            $table->dropUnique(['uuid']);
            $table->dropColumn('uuid');
        });
    }
};
