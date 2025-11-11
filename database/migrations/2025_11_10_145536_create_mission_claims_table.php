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
        Schema::create('mission_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tourist_user_id')->constrained('tourist_profiles', 'user_id')->onDelete('cascade');
            $table->foreignId('mission_id')->constrained('missions')->onDelete('cascade');

            $table->timestamp('claimed_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_claims');
    }
};
