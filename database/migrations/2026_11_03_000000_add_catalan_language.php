<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('languages') || DB::table('languages')->where('code', 'ca')->exists()) {
            return;
        }

        DB::table('languages')->insert([
            'code'        => 'ca',
            'native_name' => 'Català',
            'flag_ext'    => 'svg',
            'is_visible'  => true,
            'sort_order'  => (int) DB::table('languages')->max('sort_order') + 1,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }

    public function down(): void
    {
        if (Schema::hasTable('languages')) DB::table('languages')->where('code', 'ca')->delete();
    }
};
