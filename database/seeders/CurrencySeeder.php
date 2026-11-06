<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        $currencies = [
            ['code' => 'EUR', 'name' => 'Euro',                    'symbol' => '€',   'is_default' => true],
            ['code' => 'GBP', 'name' => 'Livre sterling',          'symbol' => '£'],
            ['code' => 'CHF', 'name' => 'Franc suisse',            'symbol' => 'CHF'],
            ['code' => 'NOK', 'name' => 'Couronne norvégienne',    'symbol' => 'kr'],
            ['code' => 'SEK', 'name' => 'Couronne suédoise',       'symbol' => 'kr'],
            ['code' => 'DKK', 'name' => 'Couronne danoise',        'symbol' => 'kr'],
            ['code' => 'PLN', 'name' => 'Złoty',                   'symbol' => 'zł'],
            ['code' => 'CZK', 'name' => 'Couronne tchèque',        'symbol' => 'Kč'],
            ['code' => 'HUF', 'name' => 'Forint',                  'symbol' => 'Ft'],
            ['code' => 'RON', 'name' => 'Leu roumain',             'symbol' => 'lei'],

            // Moyen-Orient et Russie
            ['code' => 'KWD', 'name' => 'Dinar koweïtien',         'symbol' => 'KD'],
            ['code' => 'BHD', 'name' => 'Dinar bahreïni',          'symbol' => 'BD'],
            ['code' => 'OMR', 'name' => 'Rial omanais',            'symbol' => 'OMR'],
            ['code' => 'JOD', 'name' => 'Dinar jordanien',         'symbol' => 'JD'],
            ['code' => 'RUB', 'name' => 'Rouble russe',            'symbol' => '₽'],

            // Amériques
            ['code' => 'CAD', 'name' => 'Dollar canadien',         'symbol' => 'CA$'],
            ['code' => 'USD', 'name' => 'Dollar américain',        'symbol' => '$'],
            ['code' => 'MXN', 'name' => 'Peso mexicain',           'symbol' => 'MX$'],
            ['code' => 'CLP', 'name' => 'Peso chilien',            'symbol' => 'CLP$'],
            ['code' => 'COP', 'name' => 'Peso colombien',          'symbol' => 'COL$'],
            ['code' => 'HNL', 'name' => 'Lempira hondurien',       'symbol' => 'L'],
            ['code' => 'BRL', 'name' => 'Réal brésilien',          'symbol' => 'R$'],
            ['code' => 'GTQ', 'name' => 'Quetzal guatémaltèque',   'symbol' => 'Q'],
            ['code' => 'BOB', 'name' => 'Boliviano',               'symbol' => 'Bs'],
            ['code' => 'PEN', 'name' => 'Sol péruvien',            'symbol' => 'S/'],
        ];

        // firstOrCreate : crée les devises absentes sans écraser celles qui existent
        // (taux de change, devise par défaut et ordre réglés dans /admin/currencies).
        foreach ($currencies as $i => $currency) {
            Currency::firstOrCreate(
                ['code' => $currency['code']],
                [
                    'name'          => $currency['name'],
                    'symbol'        => $currency['symbol'],
                    'exchange_rate' => 1,
                    'is_default'    => $currency['is_default'] ?? false,
                    'is_active'     => true,
                    'sort_order'    => $i + 1,
                ]
            );
        }
    }
}
