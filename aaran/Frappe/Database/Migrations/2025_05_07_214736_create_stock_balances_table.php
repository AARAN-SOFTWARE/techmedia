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
        Schema::create('stock_balances', function (Blueprint $table) {
            $table->id();
            $table->string('item_code');
            $table->string('item_group');
            $table->string('item_name');
            $table->string('brand');
            $table->string('warehouse');
            $table->decimal('opening_qty')->nullable();
            $table->decimal('opening_val')->nullable();
            $table->string('balance_qty')->nullable();
            $table->string('balance_val')->nullable();
            $table->string('valuation_rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_balances');
    }
};
