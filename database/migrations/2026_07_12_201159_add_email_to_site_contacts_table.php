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
        Schema::table('site_contacts', function (Blueprint $table) {
            $table->string('email')->nullable()->after('phone_2');
        });

        DB::table('site_contacts')->update(['email' => 'contact@mellenthinfinancial.online']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_contacts', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
