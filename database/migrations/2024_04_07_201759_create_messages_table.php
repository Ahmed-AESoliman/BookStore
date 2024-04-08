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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('room_id');
            $table->timestamps();
            $table->foreign('buyer_id')->references('id')->on('users');
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('chat_rooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
