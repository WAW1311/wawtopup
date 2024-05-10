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
        Schema::create('cart_users', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->integer('product_id');
            $table->string('category');
            $table->string('name');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('user_id');
            $table->integer('server_id');
            $table->string('status');
            $table->boolean('order_processed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_users');
    }
};
