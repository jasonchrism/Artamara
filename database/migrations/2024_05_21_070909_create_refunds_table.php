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
        Schema::create('refunds', function (Blueprint $table) {
            $table->uuid('order_id');
            $table->text('description')->nullable(false);
            $table->text('response')->nullable(false);
            $table->text('path_file')->nullable(false);
            $table->enum('status', ['ADMIN REVIEW', 'ARTIST REVIEW', 'ADMIN CONFIRMATION', 'REJECTED', 'ACCEPTED', 'FINISHED'])->nullable(false);
            $table->enum('failure_type', ['ARTIST', 'SHIPMENT']);
            $table->string('receipt_number')->nullable(false);
            $table->timestamps();

            $table->primary('order_id');
            $table->foreign('order_id')->on('orders')->references('order_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
