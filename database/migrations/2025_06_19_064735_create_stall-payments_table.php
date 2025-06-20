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
        Schema::create('stall-payments', function (Blueprint $table) {
            $table->id('booking_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('announcement_id'); // the flea market event
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->timestamps();

            $table->foreign('vendor_id')->references('vendor_id')->on('vendors')->onDelete('cascade');
            $table->foreign('announcement_id')->references('announcement_id')->on('announcements')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
