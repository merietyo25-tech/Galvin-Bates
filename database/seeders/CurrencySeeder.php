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
        ];

        foreach ($currencies as $i => $currency) {
            Currency::updateOrCreate(
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
