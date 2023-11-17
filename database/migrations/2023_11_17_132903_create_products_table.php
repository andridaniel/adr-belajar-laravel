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
            $table->string('product_name', 255);
            $table->unsignedBigInteger('category_id');
            $table->string('product_code', 20)->nullable();
            $table->enum('is_active', ['1', '0'])->default('1');
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2)->default(0.00);
            $table->string('unit', 100)->default('PCS')->comment('satuan');
            $table->decimal('discount_amount', 15, 2)->default(0.00);
            $table->integer('stock')->default(0)->comment('stock');
            $table->text('image')->nullable()->comment('gambar dari product');

            $table->unique('product_code');
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
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
