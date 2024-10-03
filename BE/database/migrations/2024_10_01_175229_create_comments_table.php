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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_variant_id');
            $table->string('content');
            $table->double('rating');
            $table->tinyInteger('status')->default(1); // 1: hiển thị, 2: ẩn
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete('cascade');
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->cascadeOnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
