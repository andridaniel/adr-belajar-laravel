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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->date('trx_date');
            $table->decimal('sub_amount', 15, 2)->nullable()->comment('total semua');
            $table->decimal('amount_total', 15, 2)->nullable()->comment('total setelah diskon');
            $table->decimal('discount_amount', 15, 0)->nullable()->comment('nominal diskon');
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->integer('total_products')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->text('description')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
