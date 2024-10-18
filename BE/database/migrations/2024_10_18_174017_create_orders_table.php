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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('discount_id');
            $table->string('code');
            $table->integer('shipping_method')->default(0);
            $table->string('fullname'); 
            $table->char('phone',20); 
            $table->string('address'); 
            $table->char('email',100);

            $table->string('note')->nullable();

            $table->integer('total_price')->nullable();
            $table->string('status')->default('pedding');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
