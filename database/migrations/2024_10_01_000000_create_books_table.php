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
        if (!Schema::hasTable('books')) {
            Schema::create('books', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('author');
                $table->text('synopsis')->nullable();
                $table->string('isbn')->unique();
                $table->decimal('price', 10, 2);
                $table->integer('stock');
                $table->string('cover')->nullable();
                $table->enum('type', ['physical', 'digital'])->default('physical');
                $table->string('status')->default('available');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

