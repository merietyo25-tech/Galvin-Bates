<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'code',
        'native_name',
        'flag_ext',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Codes des langues visibles, tries par sort_order.
     * Memoise pour la duree de la requete (meme principe que site_name() dans app/helpers.php).
     */
    public static function enabledCodes(): array
    {
        static $codes = null;

        if ($codes === null) {
            $codes = static::query()
                ->where('is_visible', true)
                ->orderBy('sort_order')
                ->pluck('code')
                ->all();
        }

        return $codes;
    }

    /**
     * Toutes les langues de la table (visibles ou non), triees : code => nom natif.
     * Source unique des listes de langues de l'administration (modeles de contrat,
     * modeles de notification, langue d'un client ou d'un dossier) : une langue ajoutee
     * dans la table apparait partout sans modifier le code.
     */
    public static function options(): array
    {
        static $options = null;

        if ($options === null) {
            $options = static::query()
                ->orderBy('sort_order')
                ->pluck('native_name', 'code')
                ->map(fn ($name, $code) => $name ?: strtoupper($code))
                ->all();
        }

        return $options;
    }

    /** Regle de validation « in: » pour un code de langue de la table. */
    public static function rule(): string
    {
        return 'in:' . implode(',', array_keys(static::options()));
    }

    /**
     * Lignes completes des langues visibles, triees par sort_order, pour les boucles d'affichage.
     */
    public static function enabledList(): Collection
    {
        static $list = null;

        if ($list === null) {
            $list = static::query()
                ->where('is_visible', true)
                ->orderBy('sort_order')
                ->get();
        }

        return $list;
    }
}
