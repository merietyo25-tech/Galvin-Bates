<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_contacts', function (Blueprint $table) {
            $table->string('name')->default('Solberg Grupo')->after('id');
            $table->string('logo_light_path')->nullable()->after('name');
            $table->string('logo_dark_path')->nullable()->after('logo_light_path');
        });
    }

    public function down(): void
    {
        Schema::table('site_contacts', function (Blueprint $table) {
            $table->dropColumn(['name', 'logo_light_path', 'logo_dark_path']);
        });
    }
};
