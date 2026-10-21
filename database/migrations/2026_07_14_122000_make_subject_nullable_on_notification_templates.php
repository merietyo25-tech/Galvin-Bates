<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * doctrine/dbal n'est pas installé dans ce projet : Blueprint::change() n'est
     * pas disponible, on modifie la colonne en SQL brut.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE notification_templates MODIFY subject VARCHAR(255) NULL');
    }

    public function down(): void
    {
        DB::statement("UPDATE notification_templates SET subject = '' WHERE subject IS NULL");
        DB::statement('ALTER TABLE notification_templates MODIFY subject VARCHAR(255) NOT NULL');
    }
};
