<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Module KYC : le champ « Pays » de l'étape 1 est enregistré dans users.country.
 * Sans cette colonne, le pays n'était jamais sauvegardé et l'étape 1 restait incomplète.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'country')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('country', 100)->nullable()->after('address');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'country')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('country');
            });
        }
    }
};
