<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Demandes de carte bancaire faites par les clients depuis leur espace.
 * Un administrateur les valide (la carte est alors émise) ou les refuse.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('card_requests')) {
            return;
        }

        Schema::create('card_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('card_type', 10)->default('virtual');      // virtual | physical
            $table->string('holder_name', 26);
            $table->string('delivery_address', 500)->nullable();      // carte physique
            $table->string('status', 12)->default('pending');         // pending | approved | rejected
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->string('rejection_reason', 500)->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('card_requests');
    }
};
