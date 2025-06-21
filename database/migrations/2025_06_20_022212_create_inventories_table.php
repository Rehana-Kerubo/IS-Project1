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
        Schema::create('inventories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
        $table->integer('stock_quantity');
        $table->decimal('buying_price', 8, 2);
        $table->decimal('selling_price', 8, 2)->nullable(); // optional override
        $table->integer('low_stock_threshold')->default(5);
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
