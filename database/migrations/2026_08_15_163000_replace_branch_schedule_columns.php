<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn(['schedule_weekday', 'schedule_weekend']);
            $table->json('schedule')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('schedule');
            $table->string('schedule_weekday')->nullable();
            $table->string('schedule_weekend')->nullable();
        });
    }
};
