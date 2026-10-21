<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

// Utilise des ALTER TABLE bruts (au lieu de Blueprint::change()) pour éviter
// d'ajouter la dépendance doctrine/dbal, absente de ce projet.
return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE users MODIFY bank_account TEXT NULL');
        DB::statement('ALTER TABLE users MODIFY bic TEXT NULL');
        DB::statement('ALTER TABLE users MODIFY id_number TEXT NULL');
        DB::statement('ALTER TABLE users MODIFY tax_number TEXT NULL');
        DB::statement('ALTER TABLE loan_requests MODIFY bank_account TEXT NULL');
        DB::statement('ALTER TABLE loan_requests MODIFY npi TEXT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE users MODIFY bank_account VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY bic VARCHAR(20) NULL');
        DB::statement('ALTER TABLE users MODIFY id_number VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY tax_number VARCHAR(255) NULL');
        DB::statement('ALTER TABLE loan_requests MODIFY bank_account VARCHAR(255) NULL');
        DB::statement('ALTER TABLE loan_requests MODIFY npi VARCHAR(255) NULL');
    }
};
