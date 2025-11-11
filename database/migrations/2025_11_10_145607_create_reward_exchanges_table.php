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
        Schema::create('reward_exchanges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tourist_user_id')->constrained('tourist_profiles', 'user_id')->onDelete('cascade');
            $table->foreignId('reward_id')->constrained('rewards')->onDelete('restrict');

            $table->timestamp('exchange_at');
            $table->string('validation_status', 20)->default('pending');
            $table->foreignId('validated_by_partner_id')->nullable()->constrained('ekraf_partners', 'user_id')->onDelete('restrict');
            $table->timestamp('validated_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_exchanges');
    }
};
