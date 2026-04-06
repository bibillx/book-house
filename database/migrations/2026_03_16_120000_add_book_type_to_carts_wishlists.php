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
        Schema::table('carts', function (Blueprint $table) {
            if (!Schema::hasColumn('carts', 'book_type')) {
                $table->enum('book_type', ['physical', 'digital'])->default('physical')->after('book_price');
            }
        });

        Schema::table('wishlists', function (Blueprint $table) {
            if (!Schema::hasColumn('wishlists', 'book_type')) {
                $table->enum('book_type', ['physical', 'digital'])->default('physical')->after('book_price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('book_type');
        });

        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropColumn('book_type');
        });
    }
};
