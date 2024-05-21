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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->string('name', 255)->nullable(false);
            $table->string('email')->unique();
            $table->string('username', 255)->nullable(false);
            $table->string('phone_number', 100)->nullable(false);
            $table->enum('role', ['ADMIN', 'BUYER', 'ARTIST'])->nullable(false);
            $table->string('password');
            $table->text('profile_picture');
            $table->text('id_photo')->nullable(true);
            $table->enum('status', ['UNVERIFIED', 'ACTIVE', 'INACTIVE'])->nullable(false);
            $table->text('about')->nullable();
            $table->timestamps();

            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
