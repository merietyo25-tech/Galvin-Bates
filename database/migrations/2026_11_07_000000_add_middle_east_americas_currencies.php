<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Ajout de devises : Moyen-Orient, Russie et Amériques.
 * N'ajoute que les devises absentes (idempotent) ; les taux de change restent à 1
 * comme les autres devises, à ajuster depuis /admin/currencies si besoin.
 */
return new class extends Migration
{
    private array $currencies = [
        // code, nom, symbole
        ['KWD', 'Dinar koweïtien',         'KD'],
        ['BHD', 'Dinar bahreïni',          'BD'],
        ['OMR', 'Rial omanais',            'OMR'],
        ['JOD', 'Dinar jordanien',         'JD'],
        ['RUB', 'Rouble russe',            '₽'],
        ['CAD', 'Dollar canadien',         'CA$'],
        ['USD', 'Dollar américain',        '$'],
        ['MXN', 'Peso mexicain',           'MX$'],
        ['CLP', 'Peso chilien',            'CLP$'],
        ['COP', 'Peso colombien',          'COL$'],
        ['HNL', 'Lempira hondurien',       'L'],
        ['BRL', 'Réal brésilien',          'R$'],
        ['GTQ', 'Quetzal guatémaltèque',   'Q'],
        ['BOB', 'Boliviano',               'Bs'],
        ['PEN', 'Sol péruvien',            'S/'],
    ];

    public function up(): void
    {
        if (! Schema::hasTable('currencies')) {
            return;
        }

        $order = (int) DB::table('currencies')->max('sort_order');

        foreach ($this->currencies as [$code, $name, $symbol]) {
            if (DB::table('currencies')->where('code', $code)->exists()) {
                continue;
            }

            DB::table('currencies')->insert([
                'code'          => $code,
                'name'          => $name,
                'symbol'        => $symbol,
                'exchange_rate' => 1,
                'is_default'    => false,
                'is_active'     => true,
                'sort_order'    => ++$order,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('currencies')) {
            DB::table('currencies')->whereIn('code', array_column($this->currencies, 0))->delete();
        }
    }
};
