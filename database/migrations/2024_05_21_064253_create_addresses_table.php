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
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('address_id');
            $table->string('street')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('postal_code')->nullable(false);
            $table->string('province')->nullable(false);
            $table->string('country')->nullable(false);
            $table->string('district')->nullable(false);
            $table->string('receiver')->nullable(false);
            $table->string('phone_number', 100)->nullable(false);
            $table->text('description');

            $table->primary('address_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
