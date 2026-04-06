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
        // Add extra fields to orders table if not exists
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('status');
            }
            if (!Schema::hasColumn('orders', 'shipping_address')) {
                $table->text('shipping_address')->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('orders', 'phone_number')) {
                $table->string('phone_number')->nullable()->after('shipping_address');
            }
        });

        // Add book_type to order_items if not exists
        Schema::table('order_items', function (Blueprint $table) {
            if (!Schema::hasColumn('order_items', 'book_type')) {
                $table->enum('book_type', ['physical', 'digital'])->default('physical')->after('book_price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'shipping_address', 'phone_number']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('book_type');
        });
    }
};
