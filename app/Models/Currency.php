<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'name',
        'symbol',
        'exchange_rate',
        'is_default',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'exchange_rate' => 'decimal:6',
        'is_default'    => 'boolean',
        'is_active'     => 'boolean',
        'sort_order'    => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Codes des devises actives, triees par sort_order.
     * Memoise pour la duree de la requete (meme principe que Language::enabledCodes()).
     */
    public static function codes(): array
    {
        static $codes = null;

        if ($codes === null) {
            $codes = static::query()
                ->active()
                ->ordered()
                ->pluck('code')
                ->all();
        }

        return $codes;
    }

    /**
     * Code de la devise par defaut.
     */
    public static function default(): string
    {
        static $default = null;

        if ($default === null) {
            $default = static::query()->where('is_default', true)->value('code') ?? 'EUR';
        }

        return $default;
    }

    /**
     * Symbole d'une devise a partir de son code.
     */
    public static function symbolFor(string $code): string
    {
        static $map = null;

        if ($map === null) {
            $map = static::query()->pluck('symbol', 'code')->all();
        }

        return $map[$code] ?? $code;
    }

    /**
     * Lignes completes des devises actives, triees par sort_order, pour les boucles d'affichage.
     */
    public static function enabledList(): Collection
    {
        static $list = null;

        if ($list === null) {
            $list = static::query()
                ->active()
                ->ordered()
                ->get();
        }

        return $list;
    }
}
