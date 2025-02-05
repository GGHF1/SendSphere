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
        Schema::create('cards', function (Blueprint $table) {
            $table->id('card_id');
            $table->unsignedBigInteger('wallet_id');
            $table->string('card_number');
            $table->date('expiry_date');
            $table->string('cardholder_name');
            $table->string('cvv');
            $table->boolean('preferred')->default(false);
            $table->string('card_type');
            $table->timestamps();

            $table->foreign('wallet_id')->references('wallet_id')->on('wallets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
