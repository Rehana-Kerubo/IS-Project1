<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('inventories', function (Blueprint $table) {
            if (!Schema::hasColumn('inventories', 'product_id')) {
                $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('inventories', 'buying_price')) {
                $table->decimal('buying_price', 8, 2)->nullable();
            }
            if (!Schema::hasColumn('inventories', 'selling_price')) {
                $table->decimal('selling_price', 8, 2)->nullable();
            }
        });
    }

    public function down(): void {
        Schema::table('inventories', function (Blueprint $table) {
            if (Schema::hasColumn('inventories', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }
            if (Schema::hasColumn('inventories', 'buying_price')) {
                $table->dropColumn('buying_price');
            }
            if (Schema::hasColumn('inventories', 'selling_price')) {
                $table->dropColumn('selling_price');
            }
        });
    }
};
