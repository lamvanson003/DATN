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
        Schema::create('product_variant_color', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variant_id');
            $table->string('color');
            $table->string('images')->nullable();
            
            $table->foreign('variant_id')->references('id')->on('product_image_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_color');
    }
};
