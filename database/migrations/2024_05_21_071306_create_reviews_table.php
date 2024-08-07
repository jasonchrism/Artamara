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
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('order_id');
            $table->integer('rating')->nullable(false);
            $table->text('comment')->nullable(false);
            $table->uuid('artist_id');
            $table->timestamps();

            $table->primary(['order_id', 'artist_id']);
            $table->foreign('order_id')->on('orders')->references('order_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('artist_id')->on('users')->references('user_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
