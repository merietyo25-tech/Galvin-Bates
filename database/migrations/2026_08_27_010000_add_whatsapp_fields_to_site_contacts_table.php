<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_contacts', function (Blueprint $table) {
            $table->string('whatsapp_number')->nullable()->after('phone_2');
            $table->boolean('whatsapp_enabled')->default(false)->after('whatsapp_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_contacts', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_number', 'whatsapp_enabled']);
        });
    }
};
