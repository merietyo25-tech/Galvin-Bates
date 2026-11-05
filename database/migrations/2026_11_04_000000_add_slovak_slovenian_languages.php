<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $languages = [
        ['code' => 'sk', 'native_name' => 'Slovenčina',  'flag_ext' => 'svg'],
        ['code' => 'sl', 'native_name' => 'Slovenščina', 'flag_ext' => 'png'],
    ];

    public function up(): void
    {
        if (! Schema::hasTable('languages')) return; foreach ($this->languages as $lang) {
            if (DB::table('languages')->where('code', $lang['code'])->exists()) {
                continue;
            }

            DB::table('languages')->insert($lang + [
                'is_visible' => true,
                'sort_order' => (int) DB::table('languages')->max('sort_order') + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('languages')) DB::table('languages')->whereIn('code', array_column($this->languages, 'code'))->delete();
    }
};
