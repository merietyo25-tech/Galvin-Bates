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
            $table->string('email_signature_path')->nullable()->after('logo_dark_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_contacts', function (Blueprint $table) {
            $table->dropColumn('email_signature_path');
        });
    }
};
