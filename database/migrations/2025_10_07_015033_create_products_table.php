<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                              // Primary key
            $table->string('name');                     // Product name
            $table->text('description')->nullable();   // Product description (optional)
            $table->decimal('price', 8, 2);            // Product price, up to 999,999.99
            $table->string('image')->nullable();       // Image filename or URL
            $table->integer('stock')->default(0);      // Quantity in stock
            $table->timestamps();                      // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
