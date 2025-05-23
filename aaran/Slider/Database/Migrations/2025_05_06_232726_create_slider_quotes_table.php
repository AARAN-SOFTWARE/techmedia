<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slider_quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slider_id')->references('id')->on('sliders')->onDelete('cascade');
            $table->text('header');
            $table->text('bg_colour')->nullable();
            $table->text('txt_colour')->nullable();
            $table->text('fill_colour')->nullable();
            $table->text('tagline')->nullable();
            $table->text('tagline_2')->nullable();
            $table->boolean('active_id')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_quotes');
    }
};
