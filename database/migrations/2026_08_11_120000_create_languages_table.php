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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->unique();
            $table->string('native_name');
            $table->string('flag_ext', 5)->default('png');
            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $languages = [
            ['code' => 'fr', 'native_name' => 'Français',   'flag_ext' => 'png'],
            ['code' => 'en', 'native_name' => 'English',    'flag_ext' => 'png'],
            ['code' => 'pl', 'native_name' => 'Polski',     'flag_ext' => 'svg'],
            ['code' => 'es', 'native_name' => 'Español',    'flag_ext' => 'png'],
            ['code' => 'bg', 'native_name' => 'Български',  'flag_ext' => 'png'],
            ['code' => 'hu', 'native_name' => 'Magyar',     'flag_ext' => 'png'],
            ['code' => 'it', 'native_name' => 'Italiano',   'flag_ext' => 'png'],
            ['code' => 'de', 'native_name' => 'Deutsch',    'flag_ext' => 'png'],
            ['code' => 'lt', 'native_name' => 'Lietuvių',   'flag_ext' => 'png'],
            ['code' => 'ro', 'native_name' => 'Română',     'flag_ext' => 'png'],
            ['code' => 'lv', 'native_name' => 'Latviešu',   'flag_ext' => 'png'],
            ['code' => 'nl', 'native_name' => 'Nederlands', 'flag_ext' => 'png'],
            ['code' => 'pt', 'native_name' => 'Português',  'flag_ext' => 'png'],
            ['code' => 'hr', 'native_name' => 'Hrvatski',   'flag_ext' => 'png'],
        ];

        foreach ($languages as $i => $lang) {
            DB::table('languages')->insert([
                'code'        => $lang['code'],
                'native_name' => $lang['native_name'],
                'flag_ext'    => $lang['flag_ext'],
                'is_visible'  => true,
                'sort_order'  => $i + 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
