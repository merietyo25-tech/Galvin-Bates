<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

// Comme le cast natif 'encrypted', mais ne plante jamais l'affichage si une
// valeur en base n'est pas (ou plus) dans un format chiffré valide — retourne
// null plutôt que de lever une DecryptException (ex. après une restauration
// de sauvegarde antérieure à l'activation du chiffrement sur cette colonne).
class SafeEncrypted implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if ($value === null || $value === '') {
            return $value;
        }

        try {
            return Crypt::decryptString($value);
        } catch (DecryptException) {
            return null;
        }
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value === null ? null : Crypt::encryptString($value);
    }
}
