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
        Schema::table('product_auctions', function (Blueprint $table) {
            $table->enum('status', ['STARTING SOON', 'ON GOING', 'CLOSED'])
                  ->default('STARTING SOON')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_auctions', function (Blueprint $table) {
            $table->enum('status', ['ON GOING', 'CLOSED'])
                  ->default('ON GOING')
                  ->change();
        });
    }
};
