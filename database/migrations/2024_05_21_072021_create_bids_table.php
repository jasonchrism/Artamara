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
        Schema::create('bids', function (Blueprint $table) {
            $table->uuid('product_id');
            $table->unsignedBigInteger('bid_price');
            $table->uuid('user_id');
            $table->timestamps();

            $table->primary(['bid_price', 'product_id']);
            $table->foreign('product_id')->on('products')->references('product_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->on('users')->references('user_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
