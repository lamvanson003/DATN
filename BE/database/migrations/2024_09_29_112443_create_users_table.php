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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); 
            $table->string('fullname')->nullable(); 
            $table->char('email',100)->unique(); 
            $table->char('username', 100)->unique(); 
            $table->tinyInteger('gender')->nullable();
            $table->string('password'); 
            $table->char('phone',20)->unique(); 
            $table->string('token')->nullable(); 
            $table->tinyInteger('status')->default(1); 
            $table->text('avatar')->nullable(); 
            $table->string('address')->nullable(); 
            $table->tinyInteger('roles')->default(2);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
