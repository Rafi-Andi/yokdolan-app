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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_user_id')->constrained('ekraf_partners', 'user_id')->onDelete('cascade');
            $table->foreignId('channel_id')->constrained('channels')->onDelete('restrict');

            $table->string('title', 128); 
            $table->text('description');
            $table->string('type', 50); 
            $table->integer('reward_points'); 
            $table->string('qr_code_unique_id', 128)->unique();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
