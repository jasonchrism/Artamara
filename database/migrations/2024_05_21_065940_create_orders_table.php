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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('order_id');
            $table->unsignedBigInteger('total_price')->nullable(false);
            $table->uuid('user_id')->nullable(false);
            $table->enum('status', ['SHIPPING', 'CONFIRMED', 'DELIVERED', 'PACKING', 'CANCELLED', 'RETURNED'])->nullable(false);
            $table->unsignedBigInteger('shipment_fee')->nullable(false);
            $table->uuid('payment_id')->nullable(false);
            $table->uuid('address_id')->nullable(false);
            $table->timestamp('end_date')->nullable(false);
            $table->boolean('is_auction')->nullable(false)->default(false);
            $table->string('receipt_number')->nullable(false);
            $table->timestamps();

            $table->primary('order_id');
            $table->foreign('user_id')->on('users')->references('user_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_id')->on('payments')->references('payment_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('address_id')->on('user_addresses')->references('address_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
