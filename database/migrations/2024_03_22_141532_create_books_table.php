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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('city');
            $table->string('town');
            $table->decimal('price');
            $table->boolean('exchangable')->default(false);
            $table->boolean('negationable')->default(false);
            $table->boolean('sold')->default(false);
            $table->boolean('state')->default(false);
            $table->boolean('status')->default(true);
            $table->integer('quantity')->default(1);
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            // $table->unsignedBigInteger('subject_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            // $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
