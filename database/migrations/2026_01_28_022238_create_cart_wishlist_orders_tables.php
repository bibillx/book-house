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
        // Create carts table
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('book_id');
            $table->string('book_title');
            $table->string('book_author');
            $table->string('book_cover')->nullable();
            $table->integer('book_price');
            $table->enum('book_type', ['physical', 'digital'])->default('physical');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        // Create wishlists table
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('book_id');
            $table->string('book_title');
            $table->string('book_author');
            $table->string('book_cover')->nullable();
            $table->integer('book_price');
            $table->enum('book_type', ['physical', 'digital'])->default('physical');
            $table->timestamps();
        });

        // Create orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->integer('total_amount');
            $table->timestamps();
        });

        // Create order_items table
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('book_id');
            $table->string('book_title');
            $table->string('book_author');
            $table->string('book_cover')->nullable();
            $table->integer('book_price');
            $table->enum('book_type', ['physical', 'digital'])->default('physical');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('carts');
    }
};
