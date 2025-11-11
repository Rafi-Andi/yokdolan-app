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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_user_id')->constrained('ekraf_partners', 'user_id')->onDelete('cascade');

            $table->string('title', 128);
            $table->text('description'); 
            $table->string('type', 50); 
            $table->decimal('points_cost', 10, 2); 
            $table->decimal('voucher_value', 10, 2)->nullable(); 
            $table->boolean('is_available')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
