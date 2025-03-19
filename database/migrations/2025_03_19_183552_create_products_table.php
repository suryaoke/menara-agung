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
            $table->string('name');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('product_code');
            $table->string('image');
            $table->date('tanggal_beli');
            $table->bigInteger('harga_beli');
            $table->bigInteger('harga_jual');
            $table->timestamps();
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
