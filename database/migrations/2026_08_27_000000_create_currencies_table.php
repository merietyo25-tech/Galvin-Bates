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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique();
            $table->string('name');
            $table->string('symbol', 10);
            $table->decimal('exchange_rate', 12, 6)->default(1);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $defaultCurrency = config('solberg.default_currency', 'EUR');
        $symbols = config('solberg.currency_symbols', []);
        $codes = config('solberg.currencies', ['EUR']);

        $names = [
            'EUR' => 'Euro',
            'GBP' => 'Livre sterling',
            'CHF' => 'Franc suisse',
            'NOK' => 'Couronne norvégienne',
            'SEK' => 'Couronne suédoise',
            'DKK' => 'Couronne danoise',
            'PLN' => 'Złoty',
            'CZK' => 'Couronne tchèque',
            'HUF' => 'Forint',
            'RON' => 'Leu roumain',
        ];

        foreach ($codes as $i => $code) {
            DB::table('currencies')->insert([
                'code'          => $code,
                'name'          => $names[$code] ?? $code,
                'symbol'        => $symbols[$code] ?? $code,
                'exchange_rate' => 1,
                'is_default'    => $code === $defaultCurrency,
                'is_active'     => true,
                'sort_order'    => $i + 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
