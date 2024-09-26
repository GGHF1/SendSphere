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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('fname');
            $table->string('lname');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id'); 
            $table->string('address');
            $table->string('zip');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->date('DOB');
            $table->string('gender');
            $table->timestamp('email_verified_at')->nullable(); 
            $table->timestamps();

            $table->foreign('country_id')->references('country_id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('city_id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['country_id']); 
            $table->dropForeign(['city_id']);    
        });

        Schema::dropIfExists('users');
    }
};
