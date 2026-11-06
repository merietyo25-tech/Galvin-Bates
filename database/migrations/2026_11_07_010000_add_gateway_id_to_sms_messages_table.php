<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Identifiant du SMS chez la passerelle (SMS Gateway) : permet d'interroger son état réel
 * (en attente du téléphone, envoyé, reçu, échec) au lieu d'afficher « Envoyé » dès que la
 * passerelle a accepté le message.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('sms_messages', 'gateway_id')) {
            Schema::table('sms_messages', function (Blueprint $table) {
                $table->string('gateway_id', 64)->nullable()->after('status');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('sms_messages', 'gateway_id')) {
            Schema::table('sms_messages', function (Blueprint $table) {
                $table->dropColumn('gateway_id');
            });
        }
    }
};
