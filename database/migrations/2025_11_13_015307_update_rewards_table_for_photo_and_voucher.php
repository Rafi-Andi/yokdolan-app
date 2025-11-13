<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('rewards', function (Blueprint $table) {
            $table->dropColumn('voucher_value');

            $table->string('reward_photo_path', 255)->nullable()->after('type'); 
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('rewards', function (Blueprint $table) {
            $table->decimal('voucher_value', 10, 2)->nullable()->after('points_cost');

            $table->dropColumn('reward_photo_path');
        });
    }
};