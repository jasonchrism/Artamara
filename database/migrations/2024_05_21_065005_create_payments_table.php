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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('payment_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->enum('status', ['PAID', 'UNPAID', 'CANCELLED'])->default('UNPAID');

            $table->primary('payment_id');
            $table->foreign('payment_method_id')->on('payment_methods')->references('payment_method_id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
