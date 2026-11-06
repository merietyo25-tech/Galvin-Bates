<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Carte SIM utilisée par le téléphone passerelle (téléphones double SIM).
 * null = choix automatique du téléphone ; 1 ou 2 = SIM imposée.
 * Une SIM sans crédit SMS ou réservée aux données provoque
 * « RESULT_ERROR_GENERIC_FAILURE » côté Android.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('sms_settings', 'sim_number')) {
            Schema::table('sms_settings', function (Blueprint $table) {
                $table->unsignedTinyInteger('sim_number')->nullable()->after('default_country_code');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('sms_settings', 'sim_number')) {
            Schema::table('sms_settings', function (Blueprint $table) {
                $table->dropColumn('sim_number');
            });
        }
    }
};
