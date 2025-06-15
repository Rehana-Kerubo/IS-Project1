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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id('vendor_id');
            $table->unsignedBigInteger('buyer_id'); // Foreign Key to buyers table

            $table->string('shop_name');
            $table->string('shop_category');
            $table->enum('status', ['unverified', 'verified'])->default('unverified');

            $table->timestamps();

            $table->foreign('buyer_id')->references('buyer_id')->on('buyers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
