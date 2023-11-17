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
        Schema::create('products_circulations', function (Blueprint $table) {
            $table->id();
            $table->date('trx_date');
            $table->string('reff', 20)->nullable();
            $table->integer('in')->default(0);
            $table->integer('out')->default(0);
            $table->unsignedBigInteger('product_id');
            $table->integer('remaining_stock');
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_circulations');
    }
};
