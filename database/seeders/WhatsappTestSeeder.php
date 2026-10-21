<?php

namespace Database\Seeders;

use App\Models\SiteContact;
use Illuminate\Database\Seeder;

/**
 * Seeder de test local uniquement : active la bulle WhatsApp avec un numero
 * factice pour verifier son affichage sur le site public. Ne pas jouer en
 * production (ecrase whatsapp_number/whatsapp_enabled sur le singleton).
 */
class WhatsappTestSeeder extends Seeder
{
    public function run(): void
    {
        SiteContact::current()->update([
            'whatsapp_number'  => '+33612345678',
            'whatsapp_enabled' => true,
        ]);
    }
}
