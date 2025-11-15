<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ekraf_partners', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('business_address');
        });

        Schema::table('channels', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ekraf_partners', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
        
        Schema::table('channels', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
};