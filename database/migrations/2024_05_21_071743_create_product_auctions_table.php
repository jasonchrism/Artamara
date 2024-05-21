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
        Schema::create('product_auctions', function (Blueprint $table) {
            $table->uuid('product_id');
            $table->unsignedBigInteger('start_price')->nullable(false);
            $table->dateTime('start_date')->nullable(false);
            $table->dateTime('end_date')->nullable(false);
            $table->unsignedBigInteger('add_price')->nullable(false);
            $table->enum('status', ['ON GOING', 'CLOSED'])->default('ON GOING');
            $table->timestamps();

            $table->primary('product_id');
            $table->foreign('product_id')->on('products')->references('product_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_auctions');
    }
};
