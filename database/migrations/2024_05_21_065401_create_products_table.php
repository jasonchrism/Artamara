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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('product_id');
            $table->text('photo')->nullable(false);
            $table->unsignedBigInteger('category_id')->nullable(false);
            $table->text('description')->nullable(false);
            $table->string('medium')->nullable(false);
            $table->string('material')->nullable(false);
            $table->unsignedBigInteger('price')->nullable(false);
            $table->integer('length')->nullable(false);
            $table->integer('width')->nullable(false);
            $table->integer('stock')->nullable(false);
            $table->integer('year')->nullable(false);
            $table->uuid('user_id')->nullable(false);
            $table->timestamps();

            $table->primary('product_id');
            $table->foreign('category_id')->on('categories')->references('category_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->on('users')->references('user_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
