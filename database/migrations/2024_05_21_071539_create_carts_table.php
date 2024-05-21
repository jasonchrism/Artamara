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
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('product_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->primary(['user_id', 'product_id']);
            $table->foreign('user_id')->on('users')->references('user_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->on('products')->references('product_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
