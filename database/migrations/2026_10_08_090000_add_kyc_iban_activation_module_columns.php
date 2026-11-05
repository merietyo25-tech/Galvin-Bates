<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Colonnes nécessaires au module KYC / IBAN / activation, ajoutées seulement si elles n'existent pas
 * (dans le projet d'origine elles étaient réparties dans plusieurs migrations mêlées à d'autres fonctionnalités).
 */
return new class extends Migration
{
    public function up(): void
    {
        // Réglages du site : BIC / code banque des IBAN générés + mode d'activation du compte
        Schema::table('site_contacts', function (Blueprint $table) {
            if (! Schema::hasColumn('site_contacts', 'default_bic')) {
                $table->string('default_bic', 11)->nullable();
            }
            if (! Schema::hasColumn('site_contacts', 'iban_bank_code')) {
                $table->string('iban_bank_code', 8)->nullable();
            }
            if (! Schema::hasColumn('site_contacts', 'activation_mail_enabled')) {
                $table->boolean('activation_mail_enabled')->default(false);
            }
            if (! Schema::hasColumn('site_contacts', 'activation_otp_enabled')) {
                $table->boolean('activation_otp_enabled')->default(false);
            }
        });

        // Carte : type et plafond de dépenses
        Schema::table('cards', function (Blueprint $table) {
            if (! Schema::hasColumn('cards', 'card_type')) {
                $table->string('card_type', 10)->default('virtual')->after('network');
            }
            if (! Schema::hasColumn('cards', 'spending_limit')) {
                $table->unsignedInteger('spending_limit')->default(1000)->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cards', fn (Blueprint $t) => $t->dropColumn(['card_type', 'spending_limit']));
        Schema::table('site_contacts', fn (Blueprint $t) => $t->dropColumn(['default_bic', 'iban_bank_code', 'activation_mail_enabled', 'activation_otp_enabled']));
    }
};
