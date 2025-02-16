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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('name');
            $table->string('sku')->unique();// SKU harus unik
            $table->text('description')->nullable();
            $table->decimal('purchase_price', 10, 2); // Contoh: 10 digit total, 2 digit di belakang koma
            $table->decimal('selling_price', 10, 2); // Contoh: 10 digit total, 2 digit di belakang koma
            $table->string('image')->nullable();
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            // Menambahkan foreign key constraint untuk category_id
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // Menambahkan foreign key constraint untuk supplier_id
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

