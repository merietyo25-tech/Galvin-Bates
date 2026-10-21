<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notification_templates', function (Blueprint $table) {
            $table->dropUnique('notification_templates_locale_unique');
            $table->string('type')->default('validation')->after('locale');
            $table->unique(['locale', 'type']);
        });
    }

    public function down(): void
    {
        Schema::table('notification_templates', function (Blueprint $table) {
            $table->dropUnique(['locale', 'type']);
            $table->dropColumn('type');
            $table->unique('locale');
        });
    }
};
