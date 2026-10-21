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
        Schema::create('site_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->timestamps();
        });

        DB::table('site_contacts')->insert([
            'address_1'  => '24 Rue de la Bourse, 75002 Paris, France',
            'address_2'  => '34 Rue du Rhône, 1204 Genève, Suisse',
            'address_3'  => '56 Bockenheimer Landstraße, 60323 Frankfurt am Main, Deutschland',
            'phone_1'    => '+31 6 57341120',
            'phone_2'    => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_contacts');
    }
};
