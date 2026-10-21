<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('enabled')->default(false);
            $table->string('driver', 20)->default('android_gateway'); // android_gateway | log
            $table->string('api_url')->nullable();
            $table->string('username')->nullable();
            $table->text('password')->nullable(); // chiffré
            $table->string('default_country_code', 6)->default('33');
            $table->timestamps();
        });

        Schema::create('sms_messages', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id', 36)->index();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sent_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('phone', 32);
            $table->text('body');
            $table->string('status', 12)->default('pending'); // sent | failed
            $table->text('error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_messages');
        Schema::dropIfExists('sms_settings');
    }
};
